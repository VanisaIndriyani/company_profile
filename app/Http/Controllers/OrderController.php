<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;
use App\Models\Catalog;
use App\Models\Order;

class OrderController extends Controller
{
    public function cart(Request $request)
    {
        $cart = session('cart', []);
        // Jika request AJAX (misal dari modal), return partial
        if ($request->ajax()) {
            return view('user.component.cart_table', compact('cart'));
        }
        // Jika akses langsung, redirect ke katalog dan buka modal
        session()->flash('open_cart_modal', true);
        return redirect()->route('catalog');
    }

    public function addToCart(Request $request)
    {
        // Validasi stok sebelum menambah ke keranjang
        $catalog = Catalog::find($request->id);
        if (!$catalog) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Produk tidak ditemukan!'], 400);
            }
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }
        
        if ($catalog->stock < $request->qty) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Stok tidak mencukupi! Stok tersedia: ' . $catalog->stock], 400);
            }
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $catalog->stock);
        }
        
        $cart = session('cart', []);
        $cart[] = [
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'image' => $request->image,
        ];
        session(['cart' => $cart]);
        
        if ($request->ajax()) {
            return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang!']);
        }
        return redirect()->route('cart');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->index]);
        session(['cart' => array_values($cart)]);
        return redirect()->route('cart');
    }

    public function checkoutForm(Request $request)
    {
        $cart = session('cart', []);
        return view('user.checkout', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }
        
        // Validasi stok sebelum checkout
        $stockErrors = [];
        foreach ($cart as $item) {
            $catalog = Catalog::find($item['id']);
            if ($catalog && $catalog->stock < $item['qty']) {
                $stockErrors[] = $item['name'] . ' - Stok tersedia: ' . $catalog->stock . ', Pesanan: ' . $item['qty'];
            }
        }
        
        if (!empty($stockErrors)) {
            return redirect()->route('cart')->with('error', 'Stok tidak mencukupi untuk beberapa produk: ' . implode(', ', $stockErrors));
        }
        
        $order = Order::create([
            'nama' => $request->nama,
            'no_meja' => $request->no_meja,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'items' => json_encode($cart),
        ]);
        
        // Kurangi stok setelah order berhasil dibuat
        foreach ($cart as $item) {
            $catalog = Catalog::find($item['id']);
            if ($catalog) {
                $catalog->stock -= $item['qty'];
                $catalog->save();
            }
        }
        
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Pesanan berhasil! Tunggu konfirmasi admin.');
    }

    public function userOrders(Request $request)
    {
        // Ambil nama/no_meja dari query string jika ada, lalu simpan ke session
        if ($request->has(['nama', 'no_meja'])) {
            session(['order_nama' => $request->nama, 'order_no_meja' => $request->no_meja]);
        }
        $nama = session('order_nama');
        $no_meja = session('order_no_meja');
        $orders = collect();
        if ($nama && $no_meja) {
            $orders = \App\Models\Order::where('nama', $nama)->where('no_meja', $no_meja)->latest()->get();
        }
        return view('user.orders', compact('orders', 'nama', 'no_meja'));
    }

    public function index(Request $request)
    {
        $query = Order::query();
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        if ($request->filled('no_meja')) {
            $query->where('no_meja', 'like', '%' . $request->no_meja . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function accept(Order $order)
    {
        // Jika pesanan sudah diterima sebelumnya, jangan kurangi stok lagi
        if ($order->status === 'accepted') {
            return redirect()->back()->with('error', 'Pesanan sudah diterima sebelumnya.');
        }
        
        // Jika pesanan sebelumnya pending, stok sudah dikurangi saat checkout
        // Jika pesanan sebelumnya rejected, kurangi stok yang sudah dikembalikan
        if ($order->status === 'rejected') {
            // Kurangi stok yang sudah dikembalikan saat reject
            $items = json_decode($order->items, true);
            foreach ($items as $item) {
                $catalog = Catalog::find($item['id']);
                if ($catalog) {
                    $catalog->stock -= $item['qty'];
                    $catalog->save();
                }
            }
        }
        
        $order->status = 'accepted';
        $order->save();
        return redirect()->back()->with('success', 'Pesanan diterima.');
    }

    public function reject(Order $order)
    {
        // Jika pesanan sudah ditolak sebelumnya, jangan kembalikan stok lagi
        if ($order->status === 'rejected') {
            return redirect()->back()->with('error', 'Pesanan sudah ditolak sebelumnya.');
        }
        
        // Kembalikan stok jika pesanan ditolak (hanya jika sebelumnya pending)
        if ($order->status === 'pending') {
            $items = json_decode($order->items, true);
            foreach ($items as $item) {
                $catalog = Catalog::find($item['id']);
                if ($catalog) {
                    $catalog->stock += $item['qty'];
                    $catalog->save();
                }
            }
        }
        
        $order->status = 'rejected';
        $order->rejection_reason = 'Pesanan ditolak karena stok habis';
        $order->save();
        return redirect()->back()->with('success', 'Pesanan ditolak dan stok dikembalikan.');
    }

    public function report()
    {
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
        return view('manager.orders_report', compact('orders'));
    }

    public function financeReport(Request $request)
    {
        $query = \App\Models\Order::where('status', 'accepted');
        $start = $request->start_date;
        $end = $request->end_date;
        if ($start) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end) {
            $query->whereDate('created_at', '<=', $end);
        }
        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('manager.finance_report', compact('orders', 'start', 'end'));
    }

    public function exportFinanceReport(Request $request)
    {
        $query = \App\Models\Order::where('status', 'accepted');
        $start = $request->start_date;
        $end = $request->end_date;
        if ($start) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end) {
            $query->whereDate('created_at', '<=', $end);
        }
        $orders = $query->orderBy('created_at', 'desc')->get();

        // Generate CSV (simple Excel)
        $filename = 'laporan_keuangan_'.now()->format('Ymd_His').'.csv';
        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, ['Nama', 'No Meja', 'Pembayaran', 'Total Harga', 'Waktu']);
        foreach ($orders as $order) {
            $orderTotal = collect(json_decode($order->items, true))->sum(function($item) {
                return $item['qty'] * $item['price'];
            });
            fputcsv($handle, [
                $order->nama,
                $order->no_meja,
                ucfirst($order->payment_method),
                $orderTotal,
                $order->created_at->format('d-m-Y H:i'),
            ]);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }

    public function receipt(Order $order)
    {
        $items = collect(json_decode($order->items, true));
        $total = $items->sum(function($item) { return $item['qty'] * $item['price']; });
        return view('admin.receipt', compact('order', 'items', 'total'));
    }
}

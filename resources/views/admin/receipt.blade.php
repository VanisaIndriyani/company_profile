<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan - {{ $order->nama }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', Arial, sans-serif; background: #fffbe6; margin:0; padding:0; }
        .receipt-container {
            max-width: 380px;
            margin: 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            padding: 32px 28px 24px 28px;
        }
        .kopi-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #6f4e37;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        .kopi-sub {
            text-align: center;
            color: #b4845c;
            font-size: 1.1rem;
            margin-bottom: 18px;
        }
        .receipt-info {
            margin-bottom: 18px;
            font-size: 1.05em;
        }
        .receipt-info span { display: inline-block; min-width: 110px; color: #6f4e37; font-weight: 600; }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .receipt-table th, .receipt-table td {
            border: none;
            padding: 6px 0;
            font-size: 1em;
        }
        .receipt-table th {
            color: #b4845c;
            font-weight: 700;
            border-bottom: 1px solid #e0c9b2;
        }
        .receipt-table td {
            color: #6f4e37;
        }
        .receipt-total {
            text-align: right;
            font-size: 1.15em;
            font-weight: 700;
            color: #6f4e37;
            margin-bottom: 12px;
        }
        .receipt-footer {
            text-align: center;
            color: #b4845c;
            font-size: 0.98em;
            margin-top: 18px;
        }
        @media print {
            body { background: #fff; }
            .receipt-container { box-shadow: none; margin:0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-container">
        <div class="kopi-title">Fourjoo Coffee</div>
        <div class="kopi-sub">Struk Pesanan</div>
        <div class="receipt-info">
            <div><span>Nama</span>: {{ $order->nama }}</div>
            <div><span>No Meja</span>: {{ $order->no_meja }}</div>
            <div><span>Pembayaran</span>: {{ ucfirst($order->payment_method) }}</div>
            <div><span>Tanggal</span>: {{ $order->created_at->format('d-m-Y H:i') }}</div>
        </div>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp{{ number_format($item['price']) }}</td>
                    <td>Rp{{ number_format($item['qty'] * $item['price']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="receipt-total">Total: Rp{{ number_format($total) }}</div>
        <div class="receipt-footer">Terima kasih telah berbelanja di Fourjoo Coffee!<br>~ Enjoy your coffee ~</div>
    </div>
</body>
</html> 
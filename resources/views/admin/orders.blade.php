@extends('layouts.admin')

@section('content')
<style>
    .orders-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        background: #fffbe6;
    }
    .orders-table th {
        background: #6f4e37;
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
    }
    .orders-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
        font-size: 1.05em;
    }
    .orders-table tr {
        transition: background 0.2s;
    }
    .orders-table tr:hover {
        background: #f5e9da;
    }
    .badge-status {
        font-size: 1em;
        border-radius: 12px;
        padding: 6px 18px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px #b4845c22;
    }
    .badge-warning { background: #ffe082; color: #6f4e37; }
    .badge-success { background: #a5d6a7; color: #2e7d32; }
    .badge-danger { background: #ffab91; color: #b71c1c; }
    .badge-secondary { background: #bdbdbd; color: #424242; }
    .card {
        border-radius: 18px !important;
        box-shadow: 0 2px 12px rgba(111, 78, 55, 0.10) !important;
        border: none !important;
    }
    .orders-title {
        color: #6f4e37;
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: 1px;
        margin-bottom: 24px;
    }
    .btn-action {
        border-radius: 50px !important;
        font-size: 1.1em;
        padding: 6px 14px;
        margin-right: 2px;
        box-shadow: 0 2px 8px #b4845c22;
        transition: background 0.2s, color 0.2s;
    }
    .btn-action.btn-success { background: #6f4e37; color: #fffbe6; border: none; }
    .btn-action.btn-success:hover { background: #5a3e2e; color: #fff; }
    .btn-action.btn-danger { background: #b71c1c; color: #fffbe6; border: none; }
    .btn-action.btn-danger:hover { background: #a31515; color: #fff; }
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Daftar Pesanan</h2>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-body">
                        <div class="orders-title">Daftar Pesanan</div>
                        <form method="GET" class="mb-4">
                            <div class="form-row align-items-end">
                                <div class="col-md-3 mb-2">
                                    <label for="search_nama">Nama</label>
                                    <input type="text" name="nama" id="search_nama" class="form-control" value="{{ request('nama') }}" placeholder="Cari nama">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="search_no_meja">No Meja</label>
                                    <input type="text" name="no_meja" id="search_no_meja" class="form-control" value="{{ request('no_meja') }}" placeholder="No Meja">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="search_status">Status</label>
                                    <select name="status" id="search_status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                                        <option value="accepted" {{ request('status')=='accepted'?'selected':'' }}>Accepted</option>
                                        <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-primary w-100" type="submit"><i class="fa fa-search"></i> Cari</button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-secondary w-100">Reset</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table orders-table mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No Meja</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Item</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->nama }}</td>
                                        <td>{{ $order->no_meja }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge badge-warning badge-status">Pending</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge badge-success badge-status">Accepted</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge badge-danger badge-status">Rejected</span>
                                            @else
                                                <span class="badge badge-secondary badge-status">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach(json_decode($order->items, true) as $item)
                                                <div style="margin-bottom:4px;">
                                                    <b>{{ $item['name'] }}</b>
                                                    — {{ $item['qty'] }} x Rp{{ number_format($item['price']) }}
                                                    = <span style="color:#6f4e37; font-weight:600;">Rp{{ number_format($item['qty'] * $item['price']) }}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <form action="{{ route('admin.orders.accept', $order) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm btn-action" title="Terima"><i class="fa fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('admin.orders.reject', $order) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm btn-action" title="Tolak"><i class="fa fa-times"></i></button>
                                                </form>
                                            @elseif($order->status == 'accepted')
                                                <a href="{{ route('admin.orders.receipt', $order) }}" target="_blank" class="btn btn-info btn-sm btn-action" title="Cetak Struk"><i class="fa fa-print"></i> Cetak Struk</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
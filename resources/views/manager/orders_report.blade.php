@extends('layouts.manager')

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
    h2 {
        color: #6f4e37;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 24px;
    }
    .card {
        border-radius: 16px !important;
        box-shadow: 0 2px 12px rgba(111, 78, 55, 0.10) !important;
        border: none !important;
    }
    .filter-form {
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .filter-select {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 8px 18px;
        font-size: 1.08em;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #6f4e37;
        background: #fffbe6;
        transition: border 0.2s;
    }
    .filter-select:focus {
        border-color: #6f4e37;
        outline: none;
    }
</style>
    <h2>Laporan Pesanan</h2>
    <form method="GET" class="filter-form">
        <label for="filter" style="font-weight:600;color:#6f4e37;">Filter:</label>
        <select name="filter" id="filter" class="filter-select" onchange="this.form.submit()">
            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
        </select>
    </form>
    <div class="card">
        <div class="card-body p-0">
            <table class="table orders-table mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No Meja</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Total Item</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->nama }}</td>
                            <td>{{ $order->no_meja }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
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
                            <td>{{ collect(json_decode($order->items, true))->sum('qty') }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 
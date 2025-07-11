@extends('layouts.manager')

@section('content')
<style>
    .finance-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        background: #fffbe6;
    }
    .finance-table th {
        background: #6f4e37;
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
    }
    .finance-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
        font-size: 1.05em;
    }
    .finance-table tr {
        transition: background 0.2s;
    }
    .finance-table tr:hover {
        background: #f5e9da;
    }
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
        margin-right: 12px;
    }
    .filter-select:focus {
        border-color: #6f4e37;
        outline: none;
    }
    .btn-export {
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 8px 22px;
        background: #6f4e37;
        border: none;
        color: #fffbe6;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px #b4845c22;
    }
    .btn-export:hover {
        background: #5a3e2e;
        color: #fff;
    }
</style>
    <h2>Laporan Keuangan</h2>
    <form method="GET" class="filter-form" id="filterForm">
        <label for="rangeSelect" style="font-weight:600;color:#6f4e37;">Filter</label>
        <select id="rangeSelect" name="range" class="filter-select">
            <option value="all">Semua</option>
            <option value="week" {{ (request('range')=='week') ? 'selected' : '' }}>Mingguan</option>
            <option value="month" {{ (request('range')=='month') ? 'selected' : '' }}>Bulanan</option>
        </select>
        <a href="{{ route('manager.finance.report.export', array_filter(['start_date' => $start, 'end_date' => $end])) }}" class="btn btn-export">Export Excel</a>
    </form>
    <script>
    document.getElementById('rangeSelect').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
    </script>
    <div class="card">
        <div class="card-body p-0">
            <table class="table finance-table mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No Meja</th>
                        <th>Pembayaran</th>
                        <th>Total Harga</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($orders as $order)
                        @php
                            $orderTotal = collect(json_decode($order->items, true))->sum(function($item) {
                                return $item['qty'] * $item['price'];
                            });
                            $total += $orderTotal;
                        @endphp
                        <tr>
                            <td>{{ $order->nama }}</td>
                            <td>{{ $order->no_meja }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>Rp{{ number_format($orderTotal) }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Pemasukan</th>
                        <th colspan="2">Rp{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection 
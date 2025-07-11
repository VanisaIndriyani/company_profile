@extends('layouts.manager')

@section('header')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .summary-card {
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        transition: box-shadow 0.3s, transform 0.3s;
        min-height: 140px;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #b4845c 0%, #f5e9da 100%);
        color: #6f4e37;
    }
    .summary-card:hover {
        box-shadow: 0 6px 24px rgba(111, 78, 55, 0.18);
        transform: translateY(-4px) scale(1.03);
    }
    .summary-icon {
        font-size: 2.5rem;
        margin-right: 18px;
        color: #fffbe6;
        background: #6f4e37;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px #b4845c;
    }
    .summary-label {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #6f4e37;
    }
    .summary-value {
        font-size: 2.1rem;
        font-weight: 700;
        color: #6f4e37;
    }
    .dashboard-title {
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: 1px;
        color: #6f4e37;
        margin-bottom: 32px;
        text-shadow: 0 2px 8px #b4845c22;
    }
    .card-title {
        color: #6f4e37;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
</style>
@endsection

@section('content')
<div class="dashboard-title">Dashboard Manager</div>
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="summary-card p-3">
            <div class="summary-icon bg-primary"><i class="fa fa-shopping-cart"></i></div>
            <div>
                <div class="summary-label">Total Pesanan</div>
                <div class="summary-value">{{ $totalOrders }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="summary-card p-3">
            <div class="summary-icon bg-success"><i class="fa fa-coins"></i></div>
            <div>
                <div class="summary-label">Total Pemasukan</div>
                <div class="summary-value">Rp{{ number_format($totalIncome) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="summary-card p-3">
            <div class="summary-icon bg-warning"><i class="fa fa-box"></i></div>
            <div>
                <div class="summary-label">Total Produk</div>
                <div class="summary-value">{{ $totalProducts }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="summary-card p-3">
            <div class="summary-icon bg-info"><i class="fa fa-blog"></i></div>
            <div>
                <div class="summary-label">Total Artikel</div>
                <div class="summary-value">{{ $totalArticles }}</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card p-3">
            <div class="card-body">
                <h5 class="card-title">Pesanan 7 Hari Terakhir</h5>
                <canvas id="ordersBar"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card p-3">
            <div class="card-body">
                <h5 class="card-title">Status Pesanan</h5>
                <canvas id="statusPie"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card p-3">
            <div class="card-body">
                <h5 class="card-title">Top 5 Produk Terlaris</h5>
                <canvas id="topProductsBar"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
const ordersBar = new Chart(document.getElementById('ordersBar'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($days->map(fn($d)=>date('d M',strtotime($d)))) !!},
        datasets: [{
            label: 'Pesanan',
            data: {!! json_encode($ordersPerDay) !!},
            backgroundColor: '#b4845c',
        }]
    },
    options: {scales: {y: {beginAtZero:true}}}
});
const statusPie = new Chart(document.getElementById('statusPie'), {
    type: 'pie',
    data: {
        labels: ['Pending','Accepted','Rejected'],
        datasets: [{
            data: [{{ $statusCounts['pending'] }},{{ $statusCounts['accepted'] }},{{ $statusCounts['rejected'] }}],
            backgroundColor: ['#ffc107','#28a745','#dc3545']
        }]
    }
});
const topProductsBar = new Chart(document.getElementById('topProductsBar'), {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($topProducts)) !!},
        datasets: [{
            label: 'Terjual',
            data: {!! json_encode(array_values($topProducts)) !!},
            backgroundColor: '#6f4e37',
        }]
    },
    options: {scales: {y: {beginAtZero:true}}}
});
</script>
@endsection 
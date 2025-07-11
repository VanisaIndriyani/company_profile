@extends('layouts.admin')
@section('content')
<style>
    .admin-welcome-card {
        background: #fffbe6;
        border-radius: 22px;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        padding: 2.5rem 2.5rem 2rem 2.5rem;
        margin-top: 48px;
        text-align: center;
    }
    .admin-welcome-title {
        color: #6f4e37;
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 2.5rem;
        letter-spacing: 1px;
        margin-bottom: 18px;
    }
    .admin-welcome-desc {
        color: #7b5e3c;
        font-size: 1.25rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
    }
</style>
    <div class="container">
        <div class="admin-welcome-card">
            <div class="admin-welcome-title">Admin Dashboard</div>
            <div class="admin-welcome-desc">Selamat datang, admin!</div>
        </div>
    </div>
@endsection 
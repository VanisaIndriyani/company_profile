@extends('layouts.superadmin')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Super Admin</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-user-secret"></i> Jumlah Admin</h5>
                    <p class="card-text" style="font-size:2em;font-weight:bold;">{{ $adminCount }}</p>
                    <a href="{{ route('users.create', ['role'=>'admin']) }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> Tambah Admin</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-user"></i> Jumlah Manager</h5>
                    <p class="card-text" style="font-size:2em;font-weight:bold;">{{ $managerCount }}</p>
                    <a href="{{ route('users.create', ['role'=>'manager']) }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> Tambah Manager</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-users"></i> Manajemen User</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-block"><i class="fa fa-cogs"></i> Kelola User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
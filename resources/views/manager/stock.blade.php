@extends('layouts.manager')

@section('content')
<style>
    .stock-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        background: #fffbe6;
    }
    .stock-table th {
        background: #6f4e37;
        color: #fffbe6;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
    }
    .stock-table td {
        vertical-align: middle;
        border: none;
        background: #fff;
        font-size: 1.05em;
    }
    .stock-table tr {
        transition: background 0.2s;
    }
    .stock-table tr:hover {
        background: #f5e9da;
    }
    .stock-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 8px #b4845c33;
        background: #fffbe6;
    }
    .form-inline {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-control-sm {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 8px 14px;
        font-size: 1em;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #6f4e37;
        background: #fffbe6;
        transition: border 0.2s;
    }
    .form-control-sm:focus {
        border-color: #6f4e37;
        outline: none;
    }
    .btn-primary {
        background: #6f4e37;
        border: none;
        border-radius: 12px;
        padding: 8px 18px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-primary:hover {
        background: #5a3e2e;
        color: #fff;
    }
    .btn-warning {
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
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
</style>
    <h2>Stok Barang</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card">
        <div class="card-body p-0">
            <table class="table stock-table mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalogs as $catalog)
                        <tr>
                            <td>{{ $catalog->name }}</td>
                            <td>Rp{{ number_format($catalog->price) }}</td>
                            <td>
                                <form action="{{ route('manager.stock.update', $catalog) }}" method="POST" class="form-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="stock" value="{{ $catalog->stock }}" min="0" class="form-control form-control-sm" style="width:80px;">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </form>
                                @if($catalog->stock <= 5 && $catalog->stock > 0)
                                    <small class="text-warning d-block mt-1"><i class="fa fa-exclamation-triangle"></i> Stok rendah!</small>
                                @elseif($catalog->stock == 0)
                                    <small class="text-danger d-block mt-1"><i class="fa fa-times-circle"></i> Stok habis!</small>
                                @endif
                            </td>
                            <td>
                                @if($catalog->image)
                                    <img src="{{ asset('catalog_image/'.$catalog->image) }}" class="stock-img">
                                @endif
                            </td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 
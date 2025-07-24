@extends('layouts.user')

@section('header')
    <style>
        .catalog-detail {
            padding: 80px 0;
            background: #fffbe6;
        }
        
        .catalog-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            border: 1px solid #f5e9da;
        }
        
        .catalog-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            margin-bottom: 2rem;
        }
        
        .catalog-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .catalog-info h1 {
            color: #6f4e37;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }
        
        .catalog-price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .catalog-description {
            color: #6c757d;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        .catalog-meta {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        
        .meta-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .meta-label {
            font-weight: 600;
            color: #6f4e37;
        }
        
        .meta-value {
            color: #6c757d;
        }
        
        .btn-order {
            background: linear-gradient(135deg, #6f4e37 0%, #8b4513 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 78, 55, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .btn-back {
            background: #6c757d;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-right: 1rem;
        }
        
        .btn-back:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }
    </style>
@endsection

@section('hero')
    <h1>{{ $catalog->name }}</h1>
    <h2>Detail Produk Katalog</h2>
    <a href="{{ route('catalog') }}" class="btn-get-started">Kembali ke Katalog</a>
@endsection

@section('content')
    <!--========================== Catalog Detail Section ============================-->
    <section class="catalog-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="catalog-image">
                        <img src="{{ asset('catalog_image/' . $catalog->image) }}" alt="{{ $catalog->name }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="catalog-card">
                        <div class="catalog-info">
                            <h1>{{ $catalog->name }}</h1>
                            <div class="catalog-price">
                                Rp {{ number_format($catalog->price, 0, ',', '.') }}
                            </div>
                            <div class="catalog-description">
                                {{ $catalog->description }}
                            </div>
                            
                            <div class="catalog-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Kategori:</span>
                                    <span class="meta-value">{{ ucfirst($catalog->category) }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Stok:</span>
                                    <span class="meta-value">{{ $catalog->stock }} unit</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Status:</span>
                                    <span class="meta-value">
                                        @if($catalog->stock > 0)
                                            <span class="badge badge-success">Tersedia</span>
                                        @else
                                            <span class="badge badge-danger">Habis</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="catalog-actions">
                                <a href="{{ route('catalog') }}" class="btn-back">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                @if($catalog->stock > 0)
                                    <a href="{{ route('cart.add') }}" class="btn-order" 
                                       onclick="event.preventDefault(); document.getElementById('add-to-cart-form').submit();">
                                        <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                                    </a>
                                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="catalog_id" value="{{ $catalog->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                    </form>
                                @else
                                    <button class="btn-order" disabled>
                                        <i class="fa fa-times"></i> Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 
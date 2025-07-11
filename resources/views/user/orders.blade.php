<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Fourjoo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <style>
        body { background: #fffbe6; font-family: 'Montserrat', 'Segoe UI', sans-serif; }
        .container { max-width: 700px; margin: 0 auto; }
    </style>
</head>
<body>
@php
    $url = request()->segment(1) ?? 'home';
@endphp
<!--========================== Header ============================-->
<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
      <a href="#hero">
        <img src="{{asset('user/images/icon.png')}}" style="margin-right:5px"/>
        <h2 class="d-inline text-light">Fourjoo</h2>
      </a>
    </div>
    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="{{$url=='home'?'menu-active':''}}"><a href="{{url('home')}}">Home</a></li>
        <li class="{{$url=='blog'?'menu-active':''}}"><a href="{{url('blog')}}">Blog</a></li>
        <li class="{{$url=='catalog'?'menu-active':''}}"><a href="{{url('catalog')}}">Catalog</a></li>
        <li class="{{$url=='contact'?'menu-active':''}}"><a href="{{url('contact')}}">Contact </a></li>
        <li>
          <a href="{{ route('cart') }}" style="position:relative">
            <i class="fa fa-shopping-cart"></i>
            @php $cartCount = is_array(session('cart')) ? count(session('cart')) : 0; @endphp
            @if($cartCount > 0)
              <span style="position:absolute;top:-8px;right:-10px;background:#e74c3c;color:#fff;border-radius:50%;padding:2px 7px;font-size:11px;">{{$cartCount}}</span>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('user.order') }}">
            <i class="fa fa-list-alt"></i> Pesanan Saya
          </a>
        </li>
      </ul>
    </nav><!-- #nav-menu-container -->
  </div>
</header><!-- #header -->

<div class="container mt-5">
    <div class="text-center mb-4">
        <img src="{{ asset('user/images/icon.png') }}" alt="Pesanan Saya" style="max-width:120px; border-radius:18px; box-shadow:0 2px 12px #b4845c33; background:#fffbe6; padding:10px;">
        <div style="font-size:1.4rem; color:#6f4e37; font-weight:700; margin-top:10px; letter-spacing:1px;">Pesanan Saya</div>
    </div>
    <form method="GET" action="">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ request('nama') ?? $nama }}" required>
        </div>
        <div class="form-group">
            <label>No Meja</label>
            <input type="text" name="no_meja" class="form-control" value="{{ request('no_meja') ?? $no_meja }}" required>
        </div>
        <button class="btn btn-primary">Lihat Pesanan</button>
    </form>
    @if($nama && $no_meja)
        @if(count($orders) > 0)
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Item</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <ul>
                            @foreach(json_decode($order->items, true) as $item)
                                <li>{{ $item['name'] }} x {{ $item['qty'] }} (Rp. {{ number_format($item['price']) }})</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>
                            {{ ucfirst($order->status) }}
                            @if($order->status == 'rejected')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $order->rejection_reason ?? 'Pesanan Anda ditolak.' }}
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-4">Tidak ada pesanan ditemukan.</div>
        @endif
    @endif
</div>
</body>
</html> 
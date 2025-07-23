<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Fourjoo Coffe</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{asset('user/images/favicon.png')}}" rel="icon">
  <link href="{{asset('user/images/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('user/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('user/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('user/css/style.css')}}" rel="stylesheet">

  @yield('header')

</head>

<body>

  @php
        $url = request()->segment(1);
  @endphp

  <!--========================== Header ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero">
          <img src="{{ asset('img/LOGO.jpg') }}" alt="Fourjo Logo" style="height:40px;margin-right:8px;vertical-align:middle;"/>
          <h2 class="d-inline text-light align-middle" style="vertical-align:middle;">Fourjo</h2>
        </a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="{{$url=='home'?'menu-active':''}}"><a href="{{url('home')}}">Home</a></li>
          <li class="{{$url=='about'?'menu-active':''}}"><a href="{{url('about')}}">About</a></li>
          <li class="{{$url=='blog'?'menu-active':''}}"><a href="{{url('blog')}}">Blog</a></li>
          <li class="{{$url=='catalog'?'menu-active':''}}"><a href="{{url('catalog')}}">Catalog</a></li>
          <li class="{{$url=='contact'?'menu-active':''}}"><a href="{{url('contact')}}">Contact </a></li>
         
          <li>
            <a href="#" data-toggle="modal" data-target="#cartModal" style="position:relative">
              <i class="fa fa-shopping-cart"></i>
              @php $cartCount = is_array(session('cart')) ? count(session('cart')) : 0; @endphp
              @if($cartCount > 0)
                <span style="position:absolute;top:-8px;right:-10px;background:#e74c3c;color:#fff;border-radius:50%;padding:2px 7px;font-size:11px;">{{$cartCount}}</span>
              @endif
            </a>
          </li>
          <li>
            <a href="#" data-toggle="modal" data-target="#orderModal" title="Cek Pesanan">
              <i class="fa fa-clipboard-list"></i>
              <span style="font-size:1em; font-weight:600; margin-left:4px;">Cek Pesanan</span>
            </a>
          </li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--========================== Hero Section ============================-->
  <section id="hero">
    <div class="hero-container">
      @yield('hero')
    </div>
  </section>

  <main id="main">
    @yield('content')
  </main>

<!-- Modal Keranjang -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#6f4e37;color:#fffbe6;">
        <h5 class="modal-title"><i class="fa fa-shopping-cart"></i> Keranjang</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        @php $cart = session('cart', []); @endphp
        
        <!-- Alert Messages -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @include('user.component.cart_table')
      </div>
    </div>
  </div>
</div>

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#6f4e37;color:#fffbe6;">
        <h5 class="modal-title"><i class="fa fa-credit-card"></i> Checkout</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- Alert Messages -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <form method="POST" action="{{ route('checkout.process') }}">
          @csrf
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>No Meja</label>
            <input type="text" name="no_meja" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Pembayaran</label>
            <select name="payment_method" class="form-control" id="payment_method" required onchange="showQris()">
              <option value="cash">Cash</option>
              <option value="qris">QRIS</option>
            </select>
          </div>
          <div class="form-group" id="qris_box" style="display:none">
            <label>Scan QRIS untuk pembayaran:</label><br>
            <img src="{{ asset('qris.jpg') }}" width="200">
          </div>
          <button type="submit" class="btn btn-primary">Proses Pesanan</button>
        </form>
        <script>
          function showQris() {
            var pm = document.getElementById('payment_method').value;
            document.getElementById('qris_box').style.display = (pm === 'qris') ? 'block' : 'none';
          }
          document.addEventListener('DOMContentLoaded', showQris);
        </script>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pesanan Saya -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#6f4e37;color:#fffbe6;">
        <h5 class="modal-title"><i class="fa fa-list-alt"></i> Pesanan Saya</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="GET" action="#orderModal" id="orderModalForm" class="mb-3">
          <div class="form-row">
            <div class="col">
              <input type="text" name="modal_nama" class="form-control" placeholder="Nama" value="{{ request('modal_nama') }}">
            </div>
            <div class="col">
              <input type="text" name="modal_no_meja" class="form-control" placeholder="No Meja" value="{{ request('modal_no_meja') }}">
            </div>
            <div class="col-auto">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </div>
        </form>
        <div id="orderModalResult">
        @php
          $modal_nama = request('modal_nama');
          $modal_no_meja = request('modal_no_meja');
          $orders = collect();
          if ($modal_nama && $modal_no_meja) {
            $orders = \App\Models\Order::where('nama', $modal_nama)->where('no_meja', $modal_no_meja)->latest()->get();
          }
        @endphp
        @if($modal_nama && $modal_no_meja && count($orders) > 0)
          <table class="table table-bordered">
            <thead><tr><th>Waktu</th><th>Item</th><th>Pembayaran</th><th>Status</th></tr></thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                  <td>
                    @foreach(json_decode($order->items, true) as $item)
                      <div>{{ $item['name'] }} x {{ $item['qty'] }} (Rp. {{ number_format($item['price']) }})</div>
                    @endforeach
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
        @elseif($modal_nama && $modal_no_meja)
          <div class="alert alert-warning mt-2">Tidak ada pesanan ditemukan.</div>
        @else
          <div class="text-muted">Masukkan nama dan no meja untuk cek pesanan.</div>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function() {
  $('#orderModalForm').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation(); // cegah bubbling
    var nama = $(this).find('input[name="modal_nama"]').val();
    var meja = $(this).find('input[name="modal_no_meja"]').val();
    $.get(window.location.pathname, {modal_nama: nama, modal_no_meja: meja}, function(data) {
      var html = $(data).find('#orderModalResult').html();
      $('#orderModalResult').html(html);
    });
    return false; // cegah bubbling
  });
  
  // Handle remove cart item
  $(document).on('click', '.remove-cart-item', function() {
    var index = $(this).data('index');
    var button = $(this);
    
    $.ajax({
      url: "{{ route('cart.remove') }}",
      method: 'POST',
      data: {
        index: index,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(res) {
        // Update cart count in header
        var newCartCount = res.cart_count || 0;
        
        if ($('a[data-target="#cartModal"] span').length > 0) {
          $('a[data-target="#cartModal"] span').text(newCartCount);
        } else {
          $('a[data-target="#cartModal"]').append('<span style="position:absolute;top:-8px;right:-10px;background:#e74c3c;color:#fff;border-radius:50%;padding:2px 7px;font-size:11px;">' + newCartCount + '</span>');
        }
        
        // Hide cart count badge if cart is empty
        if (newCartCount <= 0) {
          $('a[data-target="#cartModal"] span').hide();
        } else {
          $('a[data-target="#cartModal"] span').show();
        }
        
        // Update cart modal content
        $.get("{{ route('cart') }}", function(data) {
          $('#cartModal .modal-body').html(data);
        });
        
        // Show success message
        showAlertModal(res.success || 'Produk berhasil dihapus dari keranjang!', true);
      },
      error: function(xhr) {
        var msg = 'Terjadi kesalahan saat menghapus dari keranjang!';
        if (xhr.responseJSON && xhr.responseJSON.error) {
          msg = xhr.responseJSON.error;
        }
        showAlertModal(msg);
      }
    });
  });
});
</script>

<!-- Modal Alert Pop Up -->
<style>
  #alertModal .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
  }
  
  #alertModal .modal-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: #fff;
    justify-content: center;
    border-bottom: none;
    padding: 2rem 2rem 1.5rem 2rem;
    position: relative;
  }
  
  #alertModal .modal-header.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
  }
  
  #alertModal .modal-header.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
  }
  
  #alertModal .modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.6), rgba(255,255,255,0.3));
  }
  
  #alertModal .modal-title {
    font-size: 1.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
    letter-spacing: 0.5px;
  }
  
  #alertModal .modal-title i {
    font-size: 2rem;
    animation: bounce 0.6s ease-in-out;
  }
  
  #alertModal .modal-body {
    text-align: center;
    font-size: 1.1rem;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #495057;
    line-height: 1.6;
  }
  
  #alertModal .close {
    font-size: 1.5rem;
    opacity: 1;
    color: #fff;
    background: rgba(255,255,255,0.2);
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: absolute;
    right: 1rem;
    top: 1rem;
  }
  
  #alertModal .close:hover {
    background: rgba(255,255,255,0.3);
    transform: rotate(90deg);
  }
  
  #alertModal .modal-footer {
    border-top: none;
    justify-content: center;
    padding: 1.5rem 2rem 2rem 2rem;
    background: white;
  }
  
  #alertModal .btn {
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    font-size: 1rem;
  }
  
  #alertModal .btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
  }
  
  #alertModal .btn-success:hover {
    background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
  }
  
  #alertModal .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
  }
  
  #alertModal .btn-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
  }
  
  /* Success Animation */
  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateY(0);
    }
    40% {
      transform: translateY(-10px);
    }
    60% {
      transform: translateY(-5px);
    }
  }
  
  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  #alertModal.show .modal-content {
    animation: slideInDown 0.4s ease-out;
  }
  
  #alertModal .modal-body {
    animation: slideInUp 0.4s ease-out 0.1s both;
  }
  
  /* Shake animation for errors */
  @keyframes shake {
    0% { transform: translateX(0); }
    20% { transform: translateX(-10px); }
    40% { transform: translateX(10px); }
    60% { transform: translateX(-10px); }
    80% { transform: translateX(10px); }
    100% { transform: translateX(0); }
  }
  
  .shake {
    animation: shake 0.5s;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    #alertModal .modal-title {
      font-size: 1.5rem;
    }
    
    #alertModal .modal-body {
      font-size: 1rem;
      padding: 1.5rem;
    }
    
    #alertModal .btn {
      padding: 10px 25px;
      font-size: 0.9rem;
    }
  }
</style>
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alertModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alertModalBody">
        <!-- Pesan akan diisi via JS -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">
          <i class="fa fa-check"></i> Baik
        </button>
      </div>
    </div>
  </div>
</div>
<!-- END Modal Alert Pop Up -->

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Fourjoo</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('user/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('user/lib/superfish/superfish.min.js')}}"></script>
  <script src="{{asset('user/js/main.js')}}"></script>
  @stack('scripts')
</body>
</html> 
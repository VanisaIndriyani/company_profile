<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tata Cara Order - Fourjoo Coffee</title>
    
    <!-- Bootstrap CSS File -->
    <link href="{{asset('user/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="{{asset('user/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    
    body {
        margin: 0;
        padding: 0;
        background: #f8f9fa;
    }
    
    /* Header Styling - Same as Home */
    #header {
        background: #333;
        transition: all 0.5s;
        z-index: 997;
        padding: 15px 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
    }
    
    #header.header-scrolled {
        background: #333;
    }
    
    #header .logo {
        font-size: 30px;
        margin: 0;
        padding: 0;
        line-height: 1;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    
    #header .logo a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    
    #header .logo img {
        height: 40px;
        margin-right: 8px;
        vertical-align: middle;
    }
    
    #header .logo h2 {
        color: #fff;
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }
    
    .nav-menu {
        margin: 0;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
        margin-right: auto;
    }
    
    .nav-menu li {
        position: relative;
    }
    
    .nav-menu a {
        display: block;
        position: relative;
        color: #fff;
        padding: 10px 15px;
        transition: 0.3s;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 500;
        text-decoration: none;
        text-transform: uppercase;
    }
    
    .nav-menu a:hover,
    .nav-menu .menu-active a,
    .nav-menu li:hover > a {
        color: #18d26e;
        border-bottom: 2px solid #18d26e;
    }
    
    .nav-menu .drop-down ul {
        display: block;
        position: absolute;
        left: 0;
        top: calc(100% - 30px);
        z-index: 9;
        opacity: 0;
        visibility: hidden;
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
        transition: 0.3s;
        border-radius: 4px;
    }
    
    .nav-menu .drop-down:hover > ul {
        opacity: 1;
        top: 100%;
        visibility: visible;
    }
    
    .nav-menu .drop-down li {
        min-width: 180px;
        position: relative;
    }
    
    .nav-menu .drop-down ul a {
        padding: 10px 20px;
        font-size: 14px;
        text-transform: none;
        font-weight: 400;
        color: #37423b;
        border-radius: 0;
    }
    
    .nav-menu .drop-down ul a:hover,
    .nav-menu .drop-down ul .menu-active a {
        color: #18d26e;
    }
    
    .nav-menu .drop-down > a:after {
        content: "\f107";
        font-family: FontAwesome;
        padding-left: 10px;
    }
    
    .nav-menu .drop-down .drop-down ul {
        top: 0;
        left: calc(100% - 30px);
    }
    
    .nav-menu .drop-down .drop-down:hover > ul {
        top: 0;
        left: 100%;
    }
    
    .nav-menu .drop-down .drop-down > a:after {
        content: "\f105";
        font-family: FontAwesome;
        padding-left: 10px;
        padding-right: 10px;
    }
    
    @media (max-width: 1366px) {
        .nav-menu .drop-down .drop-down ul {
            left: -90%;
        }
        .nav-menu .drop-down .drop-down:hover > ul {
            left: -100%;
        }
    }
    
    .mobile-nav a {
        display: block;
        position: relative;
        color: #37423b;
        padding: 10px 20px;
        border-bottom: 1px solid #e6f2fb;
    }
    
    .mobile-nav a:hover,
    .mobile-nav .menu-active a,
    .mobile-nav li:hover > a {
        color: #18d26e;
    }
    
    .mobile-nav .drop-down > a:after {
        content: "\f078";
        font-family: FontAwesome;
        padding-left: 10px;
        position: absolute;
        right: 15px;
    }
    
    .mobile-nav .active .drop-down > a:after {
        content: "\f077";
    }
    
    .mobile-nav .drop-down > a {
        padding-right: 35px;
    }
    
    .mobile-nav .drop-down ul {
        display: none;
        overflow: hidden;
    }
    
    .mobile-nav .drop-down li {
        padding-left: 20px;
    }
    
    .mobile-nav-toggle {
        position: fixed;
        right: 15px;
        top: 15px;
        z-index: 9999;
        border: 0;
        background: none;
        font-size: 24px;
        transition: all 0.4s;
        outline: none !important;
        line-height: 1;
        cursor: pointer;
        text-align: right;
    }
    
    .mobile-nav-toggle i {
        color: #37423b;
    }
    
    .mobile-nav-overly {
        width: 100%;
        height: 100%;
        z-index: 9997;
        top: 0;
        left: 0;
        position: fixed;
        background: rgba(9, 9, 9, 0.6);
        overflow: hidden;
    }
    
    .mobile-nav-active {
        overflow: hidden;
    }
    
    .mobile-nav-active .mobile-nav {
        opacity: 1;
        visibility: visible;
    }
    
    .mobile-nav-active .mobile-nav-toggle i {
        color: #fff;
    }
    
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #6f4e37 0%, #8b4513 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-top: 80px; /* Add margin for fixed header */
    }
    
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero-section p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Content Section */
    .content-section {
        padding: 4rem 0;
    }
    
    .step-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .step-number {
        background: linear-gradient(135deg, #6f4e37 0%, #8b4513 100%);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    
    .step-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    
    .step-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    .step-features {
        list-style: none;
        padding: 0;
    }
    
    .step-features li {
        padding: 0.5rem 0;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .step-features li i {
        color: #28a745;
        font-size: 1.1rem;
    }
    
    /* Info Cards */
    .info-card {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .info-card h4 {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .info-card ul {
        list-style: none;
        padding: 0;
    }
    
    .info-card li {
        padding: 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .info-card li i {
        color: #ffd700;
    }
    
    /* Payment Methods */
    .payment-methods {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .payment-method {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .payment-method:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }
    
    .payment-icon {
        font-size: 2rem;
        width: 50px;
        text-align: center;
    }
    
    .payment-info h5 {
        margin: 0;
        color: #2c3e50;
    }
    
    .payment-info p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    /* Footer */
    .footer {
        background: #333;
        color: white;
        padding: 1.5rem 0;
        margin-top: 3rem;
        position: relative;
    }
    
    .footer .container {
        position: relative;
    }
    
    .footer p {
        margin: 0.5rem 0;
        font-size: 14px;
    }
    
    .footer a {
        color: #007bff;
        text-decoration: none;
    }
    
    .footer a:hover {
        text-decoration: underline;
    }
    
    /* Scroll to Top Button */
    .scroll-to-top {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
    }
    
    .scroll-to-top a {
        display: none;
        width: 40px;
        height: 40px;
        background: #555;
        color: white;
        text-align: center;
        line-height: 40px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .scroll-to-top a:hover {
        background: #007bff;
        color: white;
        text-decoration: none;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }
        
        .step-card {
            padding: 1.5rem;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
    }
    </style>
</head>
<body>
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
                    <li><a href="{{url('home')}}">HOME</a></li>
                    <li><a href="{{url('about')}}">ABOUT</a></li>
                    <li><a href="{{url('blog')}}">BLOG</a></li>
                    <li><a href="{{url('catalog')}}">CATALOG</a></li>
                    <li><a href="{{url('contact')}}">CONTACT</a></li>
                    
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
                        <a href="#" data-toggle="modal" data-target="#orderModal" title="Cek Pesanan" style="font-weight:600;">
                            CEK PESANAN
                        </a>
                    </li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><i class="fa fa-shopping-cart"></i> Tata Cara Order</h1>
            <p>Panduan lengkap cara memesan produk di Fourjoo Coffee dengan mudah dan cepat</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <!-- Step 1 -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h3 class="step-title">Pilih Produk</h3>
                        <p class="step-description">
                            Mulai dengan memilih produk yang ingin Anda pesan dari katalog kami yang beragam.
                        </p>
                        <ul class="step-features">
                            <li><i class="fa fa-check-circle"></i> Buka halaman Katalog</li>
                            <li><i class="fa fa-check-circle"></i> Lihat berbagai jenis kopi dan vape</li>
                            <li><i class="fa fa-check-circle"></i> Baca deskripsi dan harga produk</li>
                            <li><i class="fa fa-check-circle"></i> Pilih jumlah yang diinginkan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h3 class="step-title">Tambah ke Keranjang</h3>
                        <p class="step-description">
                            Setelah memilih produk, tambahkan ke keranjang belanja untuk melanjutkan proses.
                        </p>
                        <ul class="step-features">
                            <li><i class="fa fa-check-circle"></i> Klik tombol "Tambah ke Keranjang"</li>
                            <li><i class="fa fa-check-circle"></i> Pilih jumlah yang diinginkan</li>
                            <li><i class="fa fa-check-circle"></i> Produk akan masuk ke keranjang</li>
                            <li><i class="fa fa-check-circle"></i> Lanjutkan belanja atau checkout</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 3 & 4 -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h3 class="step-title">Review Keranjang</h3>
                        <p class="step-description">
                            Periksa kembali produk yang telah dipilih sebelum melanjutkan ke pembayaran.
                        </p>
                        <ul class="step-features">
                            <li><i class="fa fa-check-circle"></i> Buka keranjang belanja</li>
                            <li><i class="fa fa-check-circle"></i> Periksa produk dan jumlah</li>
                            <li><i class="fa fa-check-circle"></i> Pilih item yang ingin checkout</li>
                            <li><i class="fa fa-check-circle"></i> Hapus item yang tidak diinginkan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h3 class="step-title">Checkout & Bayar</h3>
                        <p class="step-description">
                            Lengkapi informasi pembayaran dan pilih metode pembayaran yang tersedia.
                        </p>
                        <ul class="step-features">
                            <li><i class="fa fa-check-circle"></i> Klik "Lanjut ke Checkout"</li>
                            <li><i class="fa fa-check-circle"></i> Isi nama lengkap</li>
                            <li><i class="fa fa-check-circle"></i> Masukkan nomor meja (untuk kopi)</li>
                            <li><i class="fa fa-check-circle"></i> Pilih metode pembayaran</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="info-card">
                        <h4><i class="fa fa-info-circle"></i> Informasi Penting</h4>
                        <ul>
                            <li><i class="fa fa-coffee"></i> Pesanan kopi memerlukan nomor meja</li>
                            <li><i class="fa fa-smoking"></i> Pesanan vape dapat diambil di counter</li>
                            <li><i class="fa fa-clock"></i> Pesanan akan diproses segera</li>
                            <li><i class="fa fa-phone"></i> Hubungi staff jika ada pertanyaan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="payment-methods">
                        <h4 class="mb-3"><i class="fa fa-credit-card"></i> Metode Pembayaran</h4>
                        
                        <div class="payment-method">
                            <div class="payment-icon">💵</div>
                            <div class="payment-info">
                                <h5>Cash</h5>
                                <p>Bayar tunai di counter saat mengambil pesanan</p>
                            </div>
                        </div>
                        
                        <div class="payment-method">
                            <div class="payment-icon">📱</div>
                            <div class="payment-info">
                                <h5>QRIS</h5>
                                <p>Scan QRIS untuk pembayaran digital</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="row">
                <div class="col-12">
                    <div class="step-card">
                        <h3 class="text-center mb-4"><i class="fa fa-lightbulb"></i> Tips Memesan</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <i class="fa fa-clock fa-2x text-primary mb-2"></i>
                                    <h5>Waktu Terbaik</h5>
                                    <p>Pesan di pagi hari untuk mendapatkan kopi segar dan antrian yang lebih pendek.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <i class="fa fa-users fa-2x text-success mb-2"></i>
                                    <h5>Pesan Bersama</h5>
                                    <p>Pesan bersama teman untuk menghemat waktu dan mendapatkan diskon.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <i class="fa fa-star fa-2x text-warning mb-2"></i>
                                    <h5>Produk Favorit</h5>
                                    <p>Simpan produk favorit Anda untuk pemesanan yang lebih cepat di kemudian hari.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#6f4e37;color:#fffbe6;">
                    <h5 class="modal-title">
                        <i class="fa fa-shopping-cart"></i> Keranjang
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('user.component.cart_table')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#6f4e37;color:#fffbe6;">
                    <h5 class="modal-title">
                        <i class="fa fa-clipboard-list"></i> Cek Pesanan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                    
                    @if(request('modal_nama') || request('modal_no_meja'))
                        @php
                            $query = \App\Models\Order::query();
                            if(request('modal_nama')) {
                                $query->where('nama', 'like', '%' . request('modal_nama') . '%');
                            }
                            if(request('modal_no_meja')) {
                                $query->where('no_meja', 'like', '%' . request('modal_no_meja') . '%');
                            }
                            $orders = $query->orderBy('created_at', 'desc')->get();
                        @endphp
                        
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Pesanan</th>
                                            <th>Nama</th>
                                            <th>No Meja</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->nama }}</td>
                                                <td>{{ $order->no_meja }}</td>
                                                <td>Rp{{ number_format($order->total) }}</td>
                                                <td>
                                                    @if($order->status == 'pending')
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @elseif($order->status == 'accepted')
                                                        <span class="badge badge-success">Diterima</span>
                                                    @elseif($order->status == 'rejected')
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada pesanan yang ditemukan.
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted">
                            <i class="fa fa-search fa-3x mb-3"></i>
                            <p>Masukkan nama dan/atau nomor meja untuk mencari pesanan Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p>&copy; Copyright Fourjoo. All Rights Reserved</p>
                <p>Designed by <a href="#" style="color: #007bff;">BootstrapMade</a></p>
            </div>
            <div class="scroll-to-top">
                <a href="#" id="scroll-to-top">
                    <i class="fa fa-arrow-up"></i>
                </a>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="{{asset('user/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jQuery -->
    <script src="{{asset('user/lib/jquery/jquery.min.js')}}"></script>
    
    <!-- Scroll to Top Script -->
    <script>
        $(document).ready(function() {
            // Scroll to top functionality
            $('#scroll-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            });
            
            // Show/hide scroll to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#scroll-to-top').fadeIn();
                } else {
                    $('#scroll-to-top').fadeOut();
                }
            });
        });
    </script>
</body>
</html> 
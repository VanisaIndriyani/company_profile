<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Fourjoo Coffee</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    
    /* Header Styling - Same as Other Pages */
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
    
    #header .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    #nav-menu-container {
        margin-left: auto;
    }
    
    .nav-menu {
        margin: 0;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
        margin-left: auto;
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
    
    /* Footer */
    .footer {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 2rem 0;
        margin-top: 3rem;
    }
    
    .footer h5 {
        color: #ffd700;
        margin-bottom: 1rem;
    }
    
    .footer p {
        opacity: 0.8;
        line-height: 1.6;
    }
    
    .social-links a {
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        color: #ffd700;
        transform: translateY(-2px);
    }
    
    .footer-bottom {
        background: #1a252f;
        color: white;
        text-align: center;
        padding: 1rem 0;
        margin-top: 2rem;
    }
<style>
    /* Modern Checkout Styling */
    .checkout-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        margin-top: 80px; /* Add margin for fixed header */
    }

.checkout-header {
    text-align: center;
    margin-bottom: 2rem;
    color: white;
}

.checkout-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.checkout-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.checkout-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 2rem;
    border: none;
}

.checkout-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    border: none;
}

.checkout-card-header h3 {
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkout-card-body {
    padding: 2rem;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.product-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.product-image {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    margin-right: 1rem;
    border: 2px solid #dee2e6;
}

.product-info {
    flex: 1;
}

.product-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.product-category {
    font-size: 0.85rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.product-category.coffee {
    background: #d4edda;
    color: #155724;
}

.product-category.vape {
    background: #cce5ff;
    color: #004085;
}

.product-price {
    font-weight: 700;
    color: #2dc997;
    font-size: 1.1rem;
}

.product-quantity {
    background: #007bff;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    margin-left: 1rem;
}

.total-section {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 12px;
    margin-top: 1rem;
    text-align: center;
}

.total-amount {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.payment-form {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    border: none;
}

.payment-form-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 1.5rem;
    border: none;
}

.payment-form-body {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.payment-method-select {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    background: white;
    transition: all 0.3s ease;
}

.payment-method-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.qris-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    margin-top: 1rem;
    border: 2px dashed #dee2e6;
}

.qris-image {
    max-width: 200px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.submit-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    width: 100%;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.info-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    border: none;
    margin-top: 1.5rem;
}

.info-card-header {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
    padding: 1rem 1.5rem;
    border: none;
}

.info-list {
    padding: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    border-radius: 8px;
    background: #f8f9fa;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item i {
    font-size: 1.2rem;
    width: 20px;
}

.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.alert-info-modern {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: white;
}

.alert-success-modern {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.alert-danger-modern {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

.alert-warning-modern {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.empty-cart {
    text-align: center;
    padding: 4rem 2rem;
    color: white;
}

.empty-cart i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.empty-cart h3 {
    margin-bottom: 1rem;
}

.back-to-catalog {
    background: white;
    color: #667eea;
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-to-catalog:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255,255,255,0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-header h1 {
        font-size: 2rem;
    }
    
    .checkout-card-body,
    .payment-form-body {
        padding: 1.5rem;
    }
    
    .product-item {
        flex-direction: column;
        text-align: center;
    }
    
    .product-image {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .product-quantity {
        margin-left: 0;
        margin-top: 0.5rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
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
<div class="checkout-container">
    <div class="container">
        <!-- Header -->
        <div class="checkout-header animate-fade-in-up">
            <h1><i class="fa fa-shopping-cart"></i> Checkout</h1>
            <p>Lengkapi informasi pembayaran Anda</p>
        </div>

        <!-- Alert Messages -->
        @if(session('error'))
            <div class="alert alert-danger-modern alert-modern animate-fade-in-up">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success-modern alert-modern animate-fade-in-up">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(count($cart) == 0)
            <div class="empty-cart animate-fade-in-up">
                <i class="fa fa-shopping-cart"></i>
                <h3>Keranjang Kosong</h3>
                <p>Belum ada produk di keranjang Anda</p>
                <a href="{{ route('catalog') }}" class="back-to-catalog">
                    <i class="fa fa-arrow-left"></i> Belanja Sekarang
                </a>
            </div>
        @else
            @php
                $hasCoffee = false;
                $hasVape = false;
                foreach($cart as $item) {
                    if(isset($item['category'])) {
                        if(strtolower($item['category']) == 'kopi' || strtolower($item['category']) == 'coffee') {
                            $hasCoffee = true;
                        } elseif(strtolower($item['category']) == 'vape') {
                            $hasVape = true;
                        }
                    }
                }
            @endphp

            <!-- Product Type Indicator -->
            <div class="alert alert-info-modern alert-modern animate-fade-in-up">
                <div class="d-flex align-items-center">
                    <i class="fa fa-info-circle mr-3"></i>
                    <div>
                        @if($hasCoffee && $hasVape)
                            <strong>Pesanan Campuran:</strong> Kopi memerlukan nomor meja, Vape tidak memerlukan nomor meja.
                        @elseif($hasCoffee)
                            <strong>Pesanan Kopi:</strong> Silakan isi nomor meja untuk pengiriman ke meja Anda.
                        @elseif($hasVape)
                            <strong>Pesanan Vape:</strong> Langsung pilih metode pembayaran dan ambil di counter.
                        @else
                            <strong>Pesanan:</strong> Silakan lengkapi informasi pembayaran.
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Product Details -->
                <div class="col-lg-8">
                    <div class="checkout-card animate-fade-in-up">
                        <div class="checkout-card-header">
                            <h3><i class="fa fa-shopping-cart"></i> Detail Pesanan</h3>
                        </div>
                        <div class="checkout-card-body">
                            @foreach($cart as $index => $item)
                                <div class="product-item" data-index="{{ $index }}">
                                    <img src="{{ asset('catalog_image/'.$item['image']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="product-image"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjYwIiBmaWxsPSIjRjVGNUY1Ii8+CjxwYXRoIGQ9Ik0yMCAyMEg0MFY0MEgyMFYyMFoiIGZpbGw9IiNENkQ2RDYiLz4KPC9zdmc+'">
                                    <div class="product-info">
                                        <div class="product-name">{{ $item['name'] }}</div>
                                        @if(isset($item['category']))
                                            <div class="product-category {{ strtolower($item['category']) == 'kopi' || strtolower($item['category']) == 'coffee' ? 'coffee' : 'vape' }}">
                                                <i class="fa {{ strtolower($item['category']) == 'kopi' || strtolower($item['category']) == 'coffee' ? 'fa-coffee' : 'fa-smoking' }}"></i>
                                                {{ ucfirst($item['category']) }}
                                            </div>
                                        @endif
                                        <div class="product-price">Rp{{ number_format($item['price']) }}</div>
                                    </div>
                                    <div class="product-quantity">
                                        x{{ $item['qty'] }}
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="total-section">
                                <div class="total-amount">
                                    Rp{{ number_format(collect($cart)->sum(function($item) { return $item['qty'] * $item['price']; })) }}
                                </div>
                                <div>Total Pembayaran</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Form -->
                <div class="col-lg-4">
                    <div class="payment-form animate-fade-in-up">
                        <div class="payment-form-header">
                            <h3><i class="fa fa-credit-card"></i> Informasi Pembayaran</h3>
                        </div>
                        <div class="payment-form-body">
                            <form method="POST" action="{{ route('checkout.process') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fa fa-user"></i> Nama Lengkap
                                    </label>
                                    <input type="text" name="nama" class="form-control" required 
                                           placeholder="Masukkan nama Anda">
                                </div>
                                
                                @if($hasCoffee)
                                    <div class="form-group" id="table_number_group">
                                        <label class="form-label">
                                            <i class="fa fa-table"></i> Nomor Meja
                                        </label>
                                        <input type="text" name="no_meja" class="form-control" required 
                                               placeholder="Contoh: A1, B3, dll">
                                        <small class="form-text text-muted mt-2">
                                            <i class="fa fa-info-circle"></i> Wajib diisi untuk pesanan kopi
                                        </small>
                                    </div>
                                @elseif($hasVape && !$hasCoffee)
                                    <input type="hidden" name="no_meja" value="N/A">
                                @else
                                    <input type="hidden" name="no_meja" value="N/A">
                                @endif
                                
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fa fa-money-bill"></i> Metode Pembayaran
                                    </label>
                                    <select name="payment_method" class="payment-method-select" id="payment_method" required onchange="showQris()">
                                        <option value="">Pilih metode pembayaran</option>
                                        <option value="cash">💵 Cash</option>
                                        <option value="qris">📱 QRIS</option>
                                    </select>
                                </div>
                                
                                <div class="qris-section" id="qris_box" style="display:none">
                                    <h5><i class="fa fa-qrcode"></i> Scan QRIS</h5>
                                    <img src="{{ asset('qris.jpg') }}" alt="QRIS" class="qris-image">
                                    <p class="mt-3 mb-0">
                                        <i class="fa fa-mobile"></i> Silakan scan QRIS di atas untuk melakukan pembayaran
                                    </p>
                                </div>
                                
                                <button type="submit" class="submit-btn">
                                    <i class="fa fa-check"></i> Proses Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Info Card -->
                    <div class="info-card animate-fade-in-up">
                        <div class="info-card-header">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Informasi Penting</h6>
                        </div>
                        <div class="info-list">
                            @if($hasCoffee)
                                <div class="info-item">
                                    <i class="fa fa-coffee text-success"></i>
                                    <span>Kopi akan diantar ke meja Anda</span>
                                </div>
                            @endif
                            @if($hasVape && !$hasCoffee)
                                <div class="info-item">
                                    <i class="fa fa-smoking text-info"></i>
                                    <span>Vape dapat diambil di counter - tidak perlu nomor meja</span>
                                </div>
                            @elseif($hasVape)
                                <div class="info-item">
                                    <i class="fa fa-smoking text-info"></i>
                                    <span>Vape dapat diambil di counter</span>
                                </div>
                            @endif
                            <div class="info-item">
                                <i class="fa fa-clock text-warning"></i>
                                <span>Pesanan akan diproses segera</span>
                            </div>
                            <div class="info-item">
                                <i class="fa fa-shield-alt text-primary"></i>
                                <span>Pembayaran aman dan terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function showQris() {
        var pm = document.getElementById('payment_method').value;
        document.getElementById('qris_box').style.display = (pm === 'qris') ? 'block' : 'none';
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        showQris();
        
        // Filter cart items based on selection
        var selectedItems = JSON.parse(sessionStorage.getItem('selectedCartItems') || '[]');
        
        if (selectedItems.length > 0) {
            // Hide unselected items
            document.querySelectorAll('.product-item').forEach(function(item) {
                var index = parseInt(item.getAttribute('data-index'));
                if (!selectedItems.includes(index)) {
                    item.style.display = 'none';
                }
            });
            
            // Update total calculation
            updateTotal();
        }
        
        // Auto-select payment method if only vape products
        @if($hasVape && !$hasCoffee)
            document.getElementById('payment_method').focus();
        @endif
        
        // Add animation classes
        document.querySelectorAll('.animate-fade-in-up').forEach(function(element, index) {
            element.style.animationDelay = (index * 0.1) + 's';
        });
    });
    
    function updateTotal() {
        var total = 0;
        document.querySelectorAll('.product-item:not([style*="display: none"])').forEach(function(item) {
            var priceText = item.querySelector('.product-price').textContent;
            var qtyText = item.querySelector('.product-quantity').textContent;
            
            var price = parseInt(priceText.replace('Rp', '').replace(/,/g, ''));
            var qty = parseInt(qtyText.replace('x', ''));
            
            total += price * qty;
        });
        
        document.querySelector('.total-amount').textContent = 'Rp' + total.toLocaleString('id-ID');
    }
    
    // Form validation for vape orders
    document.addEventListener('DOMContentLoaded', function() {
        var checkoutForm = document.querySelector('form[action="{{ route("checkout") }}"]');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                var hasCoffee = {{ $hasCoffee ? 'true' : 'false' }};
                var hasVape = {{ $hasVape ? 'true' : 'false' }};
                var noMejaInput = document.querySelector('input[name="no_meja"]');
                
                // If only vape products, make no_meja optional
                if (hasVape && !hasCoffee) {
                    if (noMejaInput && noMejaInput.value.trim() === '') {
                        noMejaInput.value = 'N/A';
                    }
                }
            });
        }
    });
    </script>
    
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
            <div class="row">
                <div class="col-lg-4">
                    <h5><i class="fa fa-coffee"></i> Fourjoo Coffee</h5>
                    <p>Nikmati pengalaman kopi terbaik dengan cita rasa yang autentik dan suasana yang nyaman untuk bersantai bersama teman dan keluarga.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5><i class="fa fa-map-marker-alt"></i> Lokasi</h5>
                    <p>Jl. Malioboro No. 123<br>
                    Yogyakarta, Indonesia<br>
                    Telp: (0274) 123456</p>
                </div>
                <div class="col-lg-4">
                    <h5><i class="fa fa-clock"></i> Jam Buka</h5>
                    <p>Senin - Jumat: 07:00 - 22:00<br>
                    Sabtu - Minggu: 08:00 - 23:00<br>
                    Hari Libur: 09:00 - 21:00</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2024 Fourjoo Coffee. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html> 
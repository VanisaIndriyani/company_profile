@extends('layouts.user')

@section('header')
    <style>
        /* About Page Styling - Matching Home Theme */
        #about-content {
            scroll-margin-top: 100px;
        }
        #hero{
            background: url('{{asset('user/images/layouting.jpg')}}') top center;
        }
        
        /* About Content Section */
        .about-content {
            padding: 80px 0;
            background: #fffbe6;
        }
        
        .about-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            margin-bottom: 2rem;
            border: 1px solid #f5e9da;
        }
        
        .about-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        }
        
        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .about-text h2 {
            color: #6f4e37;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 2.2rem;
        }
        
        .about-text p {
            color: #6c757d;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        /* Facilities Section Styling */
        #facilities {
            background: #fffbe6;
            padding: 80px 0;
        }
        
        .facility-box {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f5e9da;
            position: relative;
            overflow: hidden;
        }
        
        .facility-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #6f4e37;
        }
        
        .facility-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 32px rgba(111, 78, 55, 0.2);
        }
        
        .facility-icon {
            width: 80px;
            height: 80px;
            background: #6f4e37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }
        
        .facility-box:hover .facility-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 20px rgba(111, 78, 55, 0.3);
        }
        
        /* Order Guide Section Styling */
        .order-guide-section {
            background: #fffbe6;
            padding: 80px 0;
        }
        
        .order-guide-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
            border: 1px solid #f5e9da;
        }
        
        .guide-step {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: #f8f9fa;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .guide-step:hover {
            background: #e9ecef;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(111, 78, 55, 0.1);
        }
        
        .step-number {
            background: linear-gradient(135deg, #6f4e37 0%, #8b4513 100%);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 auto 1rem;
        }
        
        .guide-step h4 {
            color: #6f4e37;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .guide-step p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #6f4e37 0%, #8b4513 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 78, 55, 0.3);
        }
        
        .facility-icon i {
            font-size: 2rem;
            color: #fffbe6;
        }
        
        .facility-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #6f4e37;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }
        
        .facility-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .facility-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .feature-tag {
            background: #6f4e37;
            color: #fffbe6;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }
        
        .feature-tag:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(111, 78, 55, 0.3);
            background: #5a3e2e;
        }
        
        /* Vision Mission Section */
        .vision-mission {
            padding: 80px 0;
            background: white;
        }
        
        .vm-card {
            background: #6f4e37;
            color: #fffbe6;
            border-radius: 16px;
            padding: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(111, 78, 55, 0.13);
        }
        
        .vm-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 251, 230, 0.1);
            transform: rotate(45deg);
            transition: all 0.3s ease;
        }
        
        .vm-card:hover::before {
            transform: rotate(45deg) translate(50%, 50%);
        }
        
        .vm-card:hover {
            background: #5a3e2e;
            transform: translateY(-5px);
            box-shadow: 0 8px 32px rgba(111, 78, 55, 0.2);
        }
        
        .vm-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .vm-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }
        
        /* Section Header Styling */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title {
            color: #6f4e37;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .section-description {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .about-card {
                padding: 2rem;
            }
            
            .about-text h2 {
                font-size: 1.8rem;
            }
            
            .facility-box {
                margin-bottom: 2rem;
                padding: 1.5rem;
            }
            
            .facility-icon {
                width: 60px;
                height: 60px;
            }
            
            .facility-icon i {
                font-size: 1.5rem;
            }
            
            .facility-title {
                font-size: 1.1rem;
            }
            
            .facility-description {
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        /* Animation for facility boxes */
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
        
        .facility-box {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .facility-box:nth-child(1) { animation-delay: 0.1s; }
        .facility-box:nth-child(2) { animation-delay: 0.2s; }
        .facility-box:nth-child(3) { animation-delay: 0.3s; }
        .facility-box:nth-child(4) { animation-delay: 0.4s; }
    </style>
@endsection

@section('hero')
    <h1>Tentang Fourjoo</h1>
    <h2>Nikmati pengalaman kopi premium dan vape lounge terbaik dengan suasana yang nyaman dan pelayanan profesional</h2>
    <a href="#about-content" class="btn-get-started">Pelajari Lebih Lanjut</a>
@endsection

@section('content')

    <!--========================== About Content Section ============================-->
    <section id="about-content" class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{asset('user/images/coffeshop_layout.jpg')}}" alt="Fourjoo Coffee & Vape">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card">
                        <div class="about-text">
                            <h2>Cerita Kami</h2>
                            @if(isset($about) && count($about) > 0)
                                <p>{!! $about[0]->caption !!}</p>
                            @else
                                <p>Fourjoo adalah destinasi premium untuk pecinta kopi dan vape yang menghadirkan pengalaman unik dengan kombinasi cita rasa kopi terbaik dan fasilitas vape lounge yang lengkap. Kami berkomitmen untuk memberikan kualitas terbaik dalam setiap sajian dan pelayanan.</p>
                                <p>Dengan suasana yang nyaman dan modern, Fourjoo menjadi tempat yang sempurna untuk bersantai, bekerja, atau berkumpul dengan teman sambil menikmati secangkir kopi premium atau menghisap vape favorit Anda.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== Vision Mission Section ============================-->
    <section class="vision-mission">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="vm-card">
                        <h3>🏆 Visi Kami</h3>
                        <p>Menjadi destinasi utama untuk pengalaman kopi premium dan vape lounge terbaik di Indonesia, dengan standar kualitas tertinggi dan pelayanan yang memuaskan pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vm-card">
                        <h3>🎯 Misi Kami</h3>
                        <p>Memberikan pengalaman terbaik kepada pelanggan melalui produk berkualitas tinggi, suasana yang nyaman, dan pelayanan profesional yang konsisten dalam setiap kunjungan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== Order Guide Section ============================-->
    <section id="order-guide" class="order-guide-section">
        <div class="container">
            <div class="section-header text-center">
                <h3 class="section-title">Tata Cara Order</h3>
                <p class="section-description">Pelajari cara memesan produk dengan mudah dan cepat</p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="order-guide-card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="guide-step">
                                    <div class="step-number">1</div>
                                    <h4>Pilih Produk</h4>
                                    <p>Buka katalog dan pilih produk yang diinginkan</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="guide-step">
                                    <div class="step-number">2</div>
                                    <h4>Tambah ke Keranjang</h4>
                                    <p>Klik "Tambah ke Keranjang" dan pilih jumlah</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="guide-step">
                                    <div class="step-number">3</div>
                                    <h4>Review & Checkout</h4>
                                    <p>Periksa keranjang dan lanjut ke pembayaran</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="guide-step">
                                    <div class="step-number">4</div>
                                    <h4>Bayar & Ambil</h4>
                                    <p>Pilih metode pembayaran dan ambil pesanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('order.guide') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-book"></i> Lihat Panduan Lengkap
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== Facilities Section ============================-->
    <section id="facilities">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title">Fasilitas & Layanan</h3>
                <p class="section-description">Nikmati berbagai fasilitas dan layanan premium yang kami sediakan untuk kenyamanan Anda</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="facility-box">
                        <div class="facility-icon">
                            <i class="fa fa-coffee"></i>
                        </div>
                        <h4 class="facility-title">Kopi Premium</h4>
                        <p class="facility-description">Berbagai jenis kopi premium dengan cita rasa yang autentik dan berkualitas tinggi</p>
                        <div class="facility-features">
                            <span class="feature-tag">Arabika</span>
                            <span class="feature-tag">Robusta</span>
                            <span class="feature-tag">Cappuccino</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="facility-box">
                        <div class="facility-icon">
                            <i class="fa fa-smoking"></i>
                        </div>
                        <h4 class="facility-title">Vape Lounge</h4>
                        <p class="facility-description">Area khusus vape dengan peralatan premium dan berbagai pilihan liquid berkualitas</p>
                        <div class="facility-features">
                            <span class="feature-tag">Premium Kit</span>
                            <span class="feature-tag">Liquid</span>
                            <span class="feature-tag">Accessories</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="facility-box">
                        <div class="facility-icon">
                            <i class="fa fa-wifi"></i>
                        </div>
                        <h4 class="facility-title">Free WiFi</h4>
                        <p class="facility-description">Koneksi internet cepat dan stabil untuk mendukung aktivitas kerja dan hiburan Anda</p>
                        <div class="facility-features">
                            <span class="feature-tag">High Speed</span>
                            <span class="feature-tag">Unlimited</span>
                            <span class="feature-tag">Secure</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="facility-box">
                        <div class="facility-icon">
                            <i class="fa fa-music"></i>
                        </div>
                        <h4 class="facility-title">Live Music</h4>
                        <p class="facility-description">Hiburan musik live yang menghadirkan suasana yang nyaman dan menyenangkan</p>
                        <div class="facility-features">
                            <span class="feature-tag">Acoustic</span>
                            <span class="feature-tag">Jazz</span>
                            <span class="feature-tag">Weekend</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 
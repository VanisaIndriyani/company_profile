@extends('layouts.user')

@section('header')
    <style>
        .full-img {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 250px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        
        .full-img.loading {
            background-image: none !important;
        }
        
        .full-img.loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        .full-img:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }
        
        .full-img::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(111, 78, 55, 0.8) 0%, rgba(139, 69, 19, 0.8) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .full-img:hover::before {
            opacity: 1;
        }
        
        .full-img::after {
            content: attr(title);
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        
        .full-img:hover::after {
            opacity: 1;
        }
        
        .gallery-link {
            text-decoration: none;
            display: block;
        }
        
        .gallery-link:hover {
            text-decoration: none;
        }
        
        .badge {
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 700;
            border-radius: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .badge-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }
        
        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white;
        }
        
        .badge-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }
        
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
            border-width: 2px;
            font-weight: 600;
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border-color: #007bff;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
        }
        
        .btn-outline-success {
            color: #28a745;
            border-color: #28a745;
            transition: all 0.3s ease;
            border-width: 2px;
            font-weight: 600;
        }
        
        .btn-outline-success:hover {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            border-color: #28a745;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
        
        .content-type-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: white;
            z-index: 2;
            opacity: 0;
            transition: opacity 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        
        .blog-badge {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        
        .catalog-badge {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }
        
        .full-img:hover .content-type-badge {
            opacity: 1;
        }
        
        .no-content-message {
            padding: 60px 20px;
            background: #f8f9fa;
            border-radius: 16px;
            border: 2px dashed #dee2e6;
        }
        
        .no-content-message i {
            color: #6c757d;
        }
        
        .no-content-message h4 {
            margin-bottom: 10px;
        }
        
        .no-content-message p {
            margin-bottom: 0;
        }
        
        /* Gallery animation */
        .gallery-item {
            animation: fadeInUp 0.6s ease-out;
            margin-bottom: 2rem;
        }
        
        .gallery-item .gallery-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        
        .gallery-item .gallery-link:hover {
            text-decoration: none;
            color: inherit;
        }
        
        .gallery-item:nth-child(1) { animation-delay: 0.1s; }
        .gallery-item:nth-child(2) { animation-delay: 0.2s; }
        .gallery-item:nth-child(3) { animation-delay: 0.3s; }
        .gallery-item:nth-child(4) { animation-delay: 0.4s; }
        .gallery-item:nth-child(5) { animation-delay: 0.5s; }
        .gallery-item:nth-child(6) { animation-delay: 0.6s; }
        .gallery-item:nth-child(7) { animation-delay: 0.7s; }
        .gallery-item:nth-child(8) { animation-delay: 0.8s; }
        #hero{
            background: url('{{asset('user/images/layouting.jpg')}}') top center;
        }
        .image-center{
          display: block;
          margin-left: 6.5px;
          margin-right: 6.5px;
          width: 100%;
        }
        
        /* Article Item Styling */
        .article-item {
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        
        .article-item:hover {
            transform: translateY(-5px);
        }
        
        .article-item a {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .article-item .details {
            padding: 1rem;
            background: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .article-item .details h4 {
            color: #6f4e37;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .article-item .details span {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .article-item img {
            border-radius: 8px 8px 0 0;
            height: 200px;
            object-fit: cover;
        }
        

    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading state for gallery
            const gallerySection = document.querySelector('#contact');
            if (gallerySection) {
                gallerySection.style.opacity = '0.7';
                gallerySection.style.transition = 'opacity 0.5s ease';
                
                setTimeout(function() {
                    gallerySection.style.opacity = '1';
                }, 500);
            }
            
            // Handle image loading
            const galleryImages = document.querySelectorAll('.full-img');
            
            galleryImages.forEach(function(img) {
                const bgImage = img.style.backgroundImage;
                if (bgImage && bgImage !== 'none') {
                    const url = bgImage.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
                    const image = new Image();
                    
                    img.classList.add('loading');
                    
                    image.onload = function() {
                        img.classList.remove('loading');
                    };
                    
                    image.onerror = function() {
                        img.classList.remove('loading');
                        img.style.backgroundImage = 'url("{{ asset("user/images/gallery/placeholder.png") }}")';
                    };
                    
                    image.src = url;
                }
            });
            
            // Initialize tooltips
            if (typeof $ !== 'undefined' && $.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
            
            // Handle image loading errors
            const galleryImages = document.querySelectorAll('.full-img');
            galleryImages.forEach(function(img) {
                const bgImage = img.style.backgroundImage;
                if (bgImage && bgImage !== 'none') {
                    const url = bgImage.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
                    const image = new Image();
                    
                    image.onerror = function() {
                        console.log('Image failed to load:', url);
                        img.style.backgroundImage = 'url("{{ asset("user/images/gallery/placeholder.png") }}")';
                    };
                    
                    image.src = url;
                }
            });
        });
    </script>
@endsection

@section('hero')
    <h1>Welcome to Fourjoo</h1>
    <h2>Kami adalah agen travel terpercaya dan jaminan layanan perencanaan wisata yang mudah dan murah</h2>
    <a href="#about" class="btn-get-started">Get Started</a>
@endsection


@section('content')

      <!--========================== About Us Section ============================-->
      <section id="about">
        <div class="container">
          <div class="row about-container">

            <div class="col-lg-7 content order-lg-1 order-2">
              <h2 class="title">Tentang Kami</h2>
              <p> {!!$about[0]->caption!!}</p>
            </div>

            <div class="col-lg-5 background order-lg-2 order-1 wow fadeInRight"
                style="background: url('{{asset('about_image/'.$about[0]->image)}}') center top no-repeat; background-size: cover;"></div>
          </div>

        </div>
      </section>

      <!--========================== Services Section ============================-->
      <section id="services">
        <div class="container wow fadeIn">
          <div class="section-header">
            <h3 class="section-title">Mengapa Memilih Kami?</h3>
            <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
              <div class="box">
                <div class="icon"><i class="fa fa-shield"></i></div>
                <h4 class="title">Premium</h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
              <div class="box">
                <div class="icon"><i class="fa fa-money"></i></div>
                <h4 class="title">Harga Ekonomis</h4>
                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
              <div class="box">
                <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                <h4 class="title">Kenyamanan Pelanggan</h4>
                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
              </div>
            </div>
          </div>

        </div>
      </section><!-- #services -->



      <!--========================== Call To Action Section ============================-->
      <section id="call-to-action">
        <div class="container wow fadeIn">
          <div class="row">
            <div class="col-lg-9 text-center text-lg-left">
              <h3 class="cta-title">Bergabung dan Bekerja Sama Dengan Kami</h3>
              <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
              <a class="cta-btn align-middle" href="#">Contact</a>
            </div>
          </div>

        </div>
      </section>

      <!--========================== category Section ============================-->
      <section id="category">
        <div class="container wow fadeInUp">
          <div class="section-header">
            <h3 class="section-title">Blog Kami</h3>
            <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
          </div>
          <div class="row">

          <div class="row" id="article-wrapper">
            @if(isset($articles) && $articles->count() > 0)
                @foreach ($articles as $article)
                    <div class="col-md-4 col-sm-12 article-item">
                          <a href="{{ route('blog.show', ['slug' => $article->slug]) }}">
                            <img src="{{ asset('article_image/'.$article->image) }}" class="image-center" alt="{{ $article->title }}">
                        <div class="details">
                              <h4>{{ $article->title }}</h4>
                              <span>{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 80) }}</span>
                        </div>
                      </a>
                </div>
            @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="no-content-message">
                        <i class="fa fa-newspaper-o fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada artikel</h4>
                        <p class="text-muted">Artikel akan muncul di sini setelah Anda menambahkan konten blog.</p>
                        <div class="mt-3">
                            <a href="{{ route('manager.blog.create') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Tambah Artikel
                            </a>
                        </div>
                    </div>
                </div>
            @endif
          </div>

        </div>
        
        <!-- Blog Action Button -->
        @if(isset($articles) && $articles->count() > 0)
        <div class="container text-center mt-4">
          <a href="{{ route('blog') }}" class="btn btn-outline-primary btn-lg">
            <i class="fa fa-newspaper-o"></i> Lihat Semua Artikel
          </a>
        </div>
        @endif
      </section>

      <!--========================== Gallery Section ============================-->
      <section id="contact" style="padding-bottom:85px">
        <div class="container wow fadeInUp">
          <div class="section-header">
            <h3 class="section-title">Galeri</h3>
            <p class="section-description">Koleksi gambar dari blog dan katalog produk kami</p>
            <div class="text-center mt-3">
              <span class="badge badge-primary mr-2">Blog: {{ isset($articles) ? $articles->count() : 0 }} artikel</span>
              <span class="badge badge-success mr-2">Catalog: {{ isset($catalogs) ? $catalogs->count() : 0 }} produk</span>
              <span class="badge badge-info">Gallery: {{ isset($galleryItems) ? $galleryItems->count() : 0 }} gambar</span>
            </div>

            <div class="text-center mt-2">
              <small class="text-muted">
                <i class="fa fa-info-circle"></i> 
                Gallery menampilkan gambar dari blog dan catalog secara dinamis
              </small>
            </div>
          </div>
        </div>

        <div class="container wow fadeInUp">
              <div class="row">
                @if(isset($galleryItems) && $galleryItems->count() > 0)
                    @foreach($galleryItems as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
                            <a href="{{ $item['type'] == 'blog' ? route('blog.show', ['slug' => $item['slug'] ?? '']) : route('catalog.show', $item['id'] ?? '') }}" class="gallery-link">
                                <div class="full-img" style="background-image: url({{asset($item['image'])}})" 
                                     title="{{$item['title']}} - {{ ucfirst($item['type']) }}"
                                     data-toggle="tooltip" 
                                     data-placement="top"
                                     onerror="this.style.backgroundImage='url({{asset('user/images/gallery/placeholder.png')}})'">
                                    <div class="content-type-badge {{ $item['type'] == 'blog' ? 'blog-badge' : 'catalog-badge' }}">
                                        <i class="fa {{ $item['type'] == 'blog' ? 'fa-newspaper-o' : 'fa-shopping-cart' }}"></i>
                                        {{ ucfirst($item['type']) }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @elseif(isset($articles) && isset($catalogs) && $articles->count() == 0 && $catalogs->count() == 0)
                    <div class="col-12 text-center">
                        <div class="no-content-message">
                            <i class="fa fa-image fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada konten</h4>
                            <p class="text-muted">Gallery akan menampilkan gambar dari blog dan catalog yang Anda tambahkan.</p>
                            <div class="mt-3">
                                <a href="{{ route('manager.blog.create') }}" class="btn btn-sm btn-primary mr-2">
                                    <i class="fa fa-plus"></i> Tambah Blog
                                </a>
                                <a href="{{ route('manager.catalog.create') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> Tambah Catalog
                                </a>
                            </div>

                        </div>
                    </div>
                @elseif(isset($galleryItems) && $galleryItems->count() == 0)
                    <!-- Fallback images if no blog/catalog items -->
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/prambanan.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata2.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata3.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata4.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata5.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata6.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata7.png')}})">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 full-img" style="background-image: url({{asset('user/images/gallery/wisata8.png')}})">
                </div>
                @else
                    <!-- Default fallback if galleryItems is not set -->
                    <div class="col-12 text-center">
                        <div class="no-content-message">
                            <i class="fa fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h4 class="text-warning">Gallery tidak tersedia</h4>
                            <p class="text-muted">Terjadi kesalahan dalam memuat gallery.</p>

                        </div>
                    </div>
                @endif
              </div>
            </div>

          </div>

        </div>
        
        <!-- Gallery Action Buttons -->
        @if(isset($galleryItems) && $galleryItems->count() > 0)
        <div class="container text-center mt-4">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <a href="{{ route('blog') }}" class="btn btn-outline-primary btn-lg w-100">
                    <i class="fa fa-newspaper-o"></i> Lihat Blog
                  </a>
                </div>
                <div class="col-md-6 mb-3">
                  <a href="{{ route('catalog') }}" class="btn btn-outline-success btn-lg w-100">
                    <i class="fa fa-shopping-cart"></i> Lihat Catalog
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </section>
      
      <!-- Debug Section -->
     
@endsection

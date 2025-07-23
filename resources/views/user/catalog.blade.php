@extends('layouts.user')

@section('header')
  <style>
      #hero{
        background: url('{{asset('user/images/coffevape.jpeg')}}') top center;
        background-repeat: no-repeat;
        width:100%;
        background-size:cover;
      }
  </style>
  <link rel="stylesheet" href="{{ asset('user/css/catalog.css') }}">
@endsection

@section('hero')
    <h1>Catalog Fourjoo</h1>
    <h2>Cek semua katalog yang anda inginkan</h2>
@endsection


@section('content')
  @php
    $c = request()->input('c');
  @endphp
  <!--========================== Catalog Section ============================-->
  <section id="catalog">
    <div class="container">

      <div class="row">
        <div class="col-12 my-5">
          <div class="">
            <div class="section-header">
              <h3 class="section-title">Catalog</h3>
              <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
            </div>
          </div>
          <div class="category-filter">
            <a href="{{ route('catalog') }}" class="btn {{ !$c ? 'btn-primary' : 'btn-outline-primary' }}">
              <i class="fa fa-th-large"></i> Semua
            </a>
            <a href="{{route('catalog', ['c' => 'vape'])}}" class="btn {{$c =='vape'?'btn-primary':'btn-outline-primary'}}">
              <i class="fa fa-smoking"></i> Vape
            </a>
            <a href="{{route('catalog', ['c' => 'coffee'])}}" class="btn {{$c =='coffee'?'btn-primary':'btn-outline-primary'}}">
              <i class="fa fa-coffee"></i> Coffee
            </a>
          </div>
          
          {{-- Alert banner dihapus, hanya pakai modal pop-up --}}
          
          <div class="wow fadeInUp">
            <div class="product-grid">
              @if (count($catalogs) != 0)
                @foreach($catalogs as $item)
                <div class="product-card">
                  <div class="product-image-container">
                    @if($item->image && file_exists(public_path('catalog_image/'.$item->image)))
                      <img class="product-image" 
                           src="{{asset('catalog_image/'.$item->image)}}" 
                           alt="{{$item->name}}"
                           onerror="this.parentElement.innerHTML='<div class=\'product-image-placeholder\'><i class=\'fa fa-image fa-2x mb-2\'></i><br>Gambar tidak tersedia</div>'">
                    @else
                      <div class="product-image-placeholder">
                        <div>
                          <i class="fa fa-image fa-2x mb-2"></i>
                          <br>Gambar tidak tersedia
                        </div>
                      </div>
                    @endif
                  </div>
                  
                  <div class="product-card-body">
                    <h5 class="product-title">{{$item->name}}</h5>
                    <p class="product-description">{{$item->description}}</p>
                    
                    <div class="product-price">
                      Rp {{number_format($item->price)}}
                    </div>
                    
                    <!-- Informasi Stok -->
                    <div class="stock-badge {{ $item->stock > 0 ? ($item->stock <= 5 ? 'warning' : 'success') : 'danger' }}">
                      @if($item->stock > 0)
                        @if($item->stock <= 5)
                          <i class="fa fa-exclamation-triangle"></i> Stok: {{$item->stock}} (Hampir Habis)
                        @else
                          <i class="fa fa-check-circle"></i> Stok: {{$item->stock}}
                        @endif
                      @else
                        <i class="fa fa-times-circle"></i> Stok Habis
                      @endif
                    </div>
                    
                    <!-- Tombol Tambah ke Keranjang -->
                    @if($item->stock > 0)
                      <form method="POST" action="{{ route('cart.add') }}" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="name" value="{{ $item->name }}">
                        <input type="hidden" name="price" value="{{ $item->price }}">
                        <input type="hidden" name="image" value="{{ $item->image }}">
                        
                        <div class="d-flex align-items-center gap-2 mb-2">
                          <div class="input-group" style="width:120px;">
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-outline-secondary btn-qty-minus" tabindex="-1">-</button>
                            </div>
                            <input type="number" name="qty" value="1" min="1" class="form-control text-center input-qty" data-stock="{{ $item->stock }}" autocomplete="off">
                            <div class="input-group-append">
                              <button type="button" class="btn btn-outline-secondary btn-qty-plus" tabindex="-1">+</button>
                            </div>
                          </div>
                        </div>
                        
                        <button class="btn btn-success btn-block font-weight-bold">
                          <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                      </form>
                    @else
                      <button class="btn btn-secondary btn-block" disabled>
                        <i class="fa fa-ban"></i> Stok Habis
                      </button>
                    @endif
                  </div>
                </div>
                                @endforeach
              @else
                <div class="col-12 text-center py-5">
                  <div class="d-flex align-items-center justify-content-center mb-4">
                    <div class="code font-weight-bold text-center" style="border-right: 3px solid; font-size: 60px; padding: 0 15px 0 15px; color: #6c757d;">
                      404
                    </div>
                    <div class="text-center" style="padding: 10px; font-size: 46px; color: #6c757d;">
                      Not Found
                    </div>
                  </div>
                  <p class="text-muted">Tidak ada produk yang ditemukan.</p>
                  <a href="{{ route('catalog') }}" class="btn btn-primary">
                    <i class="fa fa-refresh"></i> Lihat Semua Produk
                  </a>
                </div>
              @endif
            </div>
          </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@push('scripts')
<script>
function showAlertModal(msg, isSuccess = false) {
  $('#alertModalLabel').html(isSuccess ? '<i class="fa fa-check-circle"></i> Sukses' : '<i class="fa fa-exclamation-triangle"></i> Peringatan');
  $('#alertModal .modal-header').removeClass('bg-success').removeClass('bg-danger').addClass(isSuccess ? 'bg-success' : 'bg-danger');
  $('#alertModalBody').text(msg);
  
  // Update button based on alert type
  var footerBtn = $('#alertModal .modal-footer .btn');
  if (isSuccess) {
    footerBtn.removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-check"></i> Baik');
  } else {
    footerBtn.removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-times"></i> Tutup');
  }
  
  // Add shake animation only for errors
  if (!isSuccess) {
    $('#alertModal .modal-content').removeClass('shake');
    void $('#alertModal .modal-content')[0].offsetWidth;
    $('#alertModal .modal-content').addClass('shake');
  }
  
  $('#alertModal').modal('show');
}
$(function() {
  // Plus-minus qty
  $('.add-to-cart-form').on('click', '.btn-qty-minus', function() {
    var input = $(this).closest('.input-group').find('.input-qty');
    var min = parseInt(input.attr('min')) || 1;
    var val = parseInt(input.val()) || min;
    if(val > min) input.val(val-1);
  });
  $('.add-to-cart-form').on('click', '.btn-qty-plus', function() {
    var input = $(this).closest('.input-group').find('.input-qty');
    var max = parseInt(input.attr('data-stock')) || 999999;
    var val = parseInt(input.val()) || 1;
    if(val < max) input.val(val+1);
  });
  // HAPUS: event handler input yang membatasi qty otomatis
  // Validasi hanya saat submit
  $('.add-to-cart-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var qtyInput = form.find('input[name="qty"]');
    var maxStock = parseInt(qtyInput.attr('data-stock')) || 999999;
    var qty = parseInt(qtyInput.val());
    if (qty > maxStock) {
      showAlertModal('Stok tidak mencukupi! Stok tersedia: ' + maxStock);
      return false;
    }
    if (qty <= 0) {
      showAlertModal('Jumlah harus lebih dari 0!');
      return false;
    }
    console.log('Sending AJAX request to:', form.attr('action'));
    console.log('Form data:', form.serialize());
    $.ajax({
      url: form.attr('action'),
      method: 'POST',
      data: form.serialize(),
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(res) {
        console.log('Success response:', res);
        // Show success message
        showAlertModal(res.success || 'Produk berhasil ditambahkan ke keranjang!', true);
        
        // Update cart count in header - get actual count from server response
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
          console.log('Cart response:', data);
          // The cart route returns the cart_table component directly when called via AJAX
          $('#cartModal .modal-body').html(data);
        });
      },
      error: function(xhr) {
        console.log('Error response:', xhr);
        var msg = 'Terjadi kesalahan saat menambah ke keranjang!';
        if (xhr.responseJSON && xhr.responseJSON.error) {
          msg = xhr.responseJSON.error;
        }
        showAlertModal(msg);
      }
    });
  });
});
</script>
@endpush

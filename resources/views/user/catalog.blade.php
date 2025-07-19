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
          <div class="d-flex justify-content-center mb-3 gap-2">
            <a href="{{ route('catalog') }}" class="btn btn-sm text-light mr-3 {{ !$c ? 'btn-primary' : 'btn-secondary' }}">All</a>
            <a href="{{route('catalog', ['c' => 'vape'])}}" class="btn btn-sm text-light mr-3 {{$c =='vape'?'btn-primary':'btn-secondary'}}">Vape</a>
            <a href="{{route('catalog', ['c' => 'coffee'])}}" class="btn btn-sm text-light {{$c =='coffee'?'btn-primary':'btn-secondary'}}">Coffee</a>
          </div>
          
          {{-- Alert banner dihapus, hanya pakai modal pop-up --}}
          
          <div class=" wow fadeInUp">
            <div class="row" style="">
              <div class="card-deck">
                @if (count($catalogs) != 0)
                  @foreach($catalogs as $item)
                  <div class="col-lg-4 col-md-6">
                      <div class="card my-3" style="min-width: 328px;">
                        <img class="card-img-top" src="{{asset('catalog_image/'.$item->image)}}" alt="Card image cap" style="width:328px; height: 200px; object-fit: cover;">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">{{$item->name}}</h5>
                          <p class="card-text">{{$item->description}}</p>
                          <div class="row mt-3">
                            <div class="col text-right d-flex">
                              <h5 class="mr-auto card-text">Harga</h5>
                              <p class="font-weight-bold" style="color: #2dc997">Rp. {{$item->price}}</p>
                            </div>
                          </div>
                          <!-- Informasi Stok -->
                          <div class="row mt-2 mb-2">
                            <div class="col-12">
                              @if($item->stock > 0)
                                @if($item->stock <= 5)
                                  <span class="badge badge-warning px-2 py-1" style="font-size:0.95em; margin-bottom:4px;">Stok: {{$item->stock}} (Hampir Habis)</span>
                                @else
                                  <span class="badge badge-success px-2 py-1" style="font-size:0.95em; margin-bottom:4px;">Stok: {{$item->stock}}</span>
                                @endif
                              @else
                                <span class="badge badge-danger px-2 py-1 d-block text-center" style="font-size:0.95em; margin-bottom:4px;">Stok Habis</span>
                              @endif
                            </div>
                          </div>
                          <!-- Tombol Tambah ke Keranjang -->
                          <div class="row">
                            <div class="col-12 d-flex justify-content-{{ $item->stock > 0 ? 'start' : 'center' }} align-items-center">
                              @if($item->stock > 0)
                                <form method="POST" action="{{ route('cart.add') }}" class="add-to-cart-form d-flex align-items-center w-100" style="gap:8px;">
                                  @csrf
                                  <input type="hidden" name="id" value="{{ $item->id }}">
                                  <input type="hidden" name="name" value="{{ $item->name }}">
                                  <input type="hidden" name="price" value="{{ $item->price }}">
                                  <input type="hidden" name="image" value="{{ $item->image }}">
                                  <div class="input-group" style="width:120px; flex-wrap:nowrap;">
                                    <div class="input-group-prepend">
                                      <button type="button" class="btn btn-outline-secondary btn-qty-minus" tabindex="-1">-</button>
                                    </div>
                                    <input type="number" name="qty" value="1" min="1" class="form-control text-center input-qty" style="width:70px;" data-stock="{{ $item->stock }}" autocomplete="off">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-outline-secondary btn-qty-plus" tabindex="-1">+</button>
                                    </div>
                                  </div>
                                  <button class="btn btn-success btn-sm ml-2 px-3 font-weight-bold"><i class="fa fa-shopping-cart"></i> Tambah ke Keranjang</button>
                                </form>
                              @else
                                <button class="btn btn-secondary btn-sm w-100" disabled>Stok Habis</button>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  @endforeach
                @else
                  <div class="mt-5 d-flex align-items-center justify-content-center" style="height: 10vh;">
                    <div class="code font-weight-bold text-center" style="border-right: 3px solid; font-size: 60px; padding: 0 15px 0 15px;">
                      404
                    </div>
                    <div class="text-center" style="padding: 10px; font-size: 46px;">
                      Not Found
                    </div>
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
  $('#alertModalLabel').html(isSuccess ? '<i class="fa fa-check-circle"></i> Sukses' : 'Peringatan');
  $('#alertModal .modal-header').removeClass('bg-success').removeClass('bg-danger').addClass(isSuccess ? 'bg-success' : 'bg-danger');
  $('#alertModalBody').text(msg);
  $('#alertModal .modal-content').removeClass('shake');
  void $('#alertModal .modal-content')[0].offsetWidth;
  $('#alertModal .modal-content').addClass('shake');
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
        
        // Update cart count in header
        var cartCount = $('a[data-target="#cartModal"] span').length > 0 ? 
          parseInt($('a[data-target="#cartModal"] span').text()) : 0;
        cartCount++;
        
        if ($('a[data-target="#cartModal"] span').length > 0) {
          $('a[data-target="#cartModal"] span').text(cartCount);
        } else {
          $('a[data-target="#cartModal"]').append('<span style="position:absolute;top:-8px;right:-10px;background:#e74c3c;color:#fff;border-radius:50%;padding:2px 7px;font-size:11px;">' + cartCount + '</span>');
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

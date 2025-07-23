<style>
  .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #6f4e37;
    border-color: #6f4e37;
  }
  
  .custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.25);
  }
  
  .custom-checkbox .custom-control-label::before {
    border-radius: 4px;
  }
  
  .custom-checkbox .custom-control-label::after {
    border-radius: 4px;
  }
  
  .item-row.disabled {
    opacity: 0.6;
    background-color: #f8f9fa;
  }
  
  .item-row.disabled td {
    color: #6c757d;
  }
</style>

@if(isset($cart) && count($cart) > 0)
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="selectAll" checked>
              <label class="custom-control-label" for="selectAll">Pilih Semua</label>
            </div>
          </th>
          <th>Produk</th>
          <th>Kategori</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Subtotal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart as $index => $item)
          <tr>
            <td>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input item-checkbox" 
                       id="item{{ $index }}" 
                       data-index="{{ $index }}"
                       data-price="{{ $item['price'] }}"
                       data-qty="{{ $item['qty'] }}"
                       checked>
                <label class="custom-control-label" for="item{{ $index }}"></label>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                @if(isset($item['image']))
                  <img src="{{ asset('catalog_image/'.$item['image']) }}" 
                       alt="{{ $item['name'] }}" 
                       class="mr-3" 
                       style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                @endif
                <div>
                  <strong>{{ $item['name'] }}</strong>
                </div>
              </div>
            </td>
            <td>
              @if(isset($item['category']))
                @if(strtolower($item['category']) == 'kopi' || strtolower($item['category']) == 'coffee')
                  <span class="badge badge-success">
                    <i class="fa fa-coffee"></i> {{ ucfirst($item['category']) }}
                  </span>
                @elseif(strtolower($item['category']) == 'vape')
                  <span class="badge badge-info">
                    <i class="fa fa-smoking"></i> {{ ucfirst($item['category']) }}
                  </span>
                @else
                  <span class="badge badge-secondary">{{ ucfirst($item['category']) }}</span>
                @endif
              @else
                <span class="badge badge-secondary">N/A</span>
              @endif
            </td>
            <td>
              <span class="badge badge-primary">{{ $item['qty'] }}</span>
            </td>
            <td>Rp{{ number_format($item['price']) }}</td>
            <td><strong>Rp{{ number_format($item['qty'] * $item['price']) }}</strong></td>
            <td>
              <button type="button" class="btn btn-sm btn-outline-danger remove-cart-item" 
                      data-index="{{ $index }}">
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot class="table-active">
        <tr>
          <th colspan="5" class="text-right">Total:</th>
          <th class="text-primary" style="font-size: 1.1em;" id="cartTotal">
            Rp{{ number_format(collect($cart)->sum(function($item) { return $item['qty'] * $item['price']; })) }}
          </th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
  
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
  
  <div class="text-right">
    <div class="mb-3">
      @if($hasCoffee && $hasVape)
        <div class="alert alert-info py-2 mb-0">
          <i class="fa fa-info-circle"></i> <strong>Pesanan Campuran:</strong> Kopi memerlukan nomor meja, Vape tidak memerlukan nomor meja.
        </div>
      @elseif($hasCoffee)
        <div class="alert alert-success py-2 mb-0">
          <i class="fa fa-coffee"></i> <strong>Pesanan Kopi:</strong> Akan diminta nomor meja untuk pengiriman ke meja Anda.
        </div>
      @elseif($hasVape)
        <div class="alert alert-info py-2 mb-0">
          <i class="fa fa-smoking"></i> <strong>Pesanan Vape:</strong> Langsung ke pembayaran dan ambil di counter.
        </div>
      @endif
    </div>
    <button type="button" class="btn btn-warning btn-lg" id="checkoutBtn" onclick="proceedToCheckout()">
      <i class="fa fa-credit-card"></i> Lanjut ke Checkout
    </button>
  </div>
@else
  <div class="text-center text-muted py-4">
    <i class="fa fa-shopping-cart fa-3x mb-3"></i>
    <p>Keranjang kosong.</p>
    <a href="{{ route('catalog') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Belanja Sekarang
    </a>
  </div>
@endif 

<script>
$(document).ready(function() {
  // Select All functionality
  $('#selectAll').change(function() {
    var isChecked = $(this).is(':checked');
    
    // Update all item checkboxes
    $('.item-checkbox').prop('checked', isChecked);
    
    // Update total and styles
    updateTotal();
    updateRowStyles();
  });
  
  // Individual item checkbox
  $(document).on('change', '.item-checkbox', function() {
    updateSelectAll();
    updateTotal();
    updateRowStyles();
  });
  
  // Remove cart item functionality
  $(document).on('click', '.remove-cart-item', function(e) {
    e.preventDefault();
    
    var index = $(this).data('index');
    var button = $(this);
    
    if (confirm('Hapus item ini dari keranjang?')) {
      // Disable button to prevent double click
      button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
      
      $.ajax({
        url: '{{ route("cart.remove") }}',
        type: 'POST',
        data: {
          index: index,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            // Remove the row from table
            button.closest('tr').fadeOut(300, function() {
              $(this).remove();
              
              // Update cart count in header
              if (response.cart_count > 0) {
                $('.cart-badge').text(response.cart_count);
              } else {
                $('.cart-badge').hide();
              }
              
              // If no items left, reload the modal content
              if (response.cart_count === 0) {
                location.reload();
              } else {
                // Update total
                updateTotal();
                updateSelectAll();
                updateRowStyles();
              }
            });
            
            // Show success message
            showAlertModal('Item berhasil dihapus dari keranjang!');
          } else {
            showAlertModal('Gagal menghapus item dari keranjang!');
          }
        },
        error: function() {
          showAlertModal('Terjadi kesalahan saat menghapus item!');
        },
        complete: function() {
          // Re-enable button
          button.prop('disabled', false).html('<i class="fa fa-trash"></i>');
        }
      });
    }
  });
  
  function updateSelectAll() {
    var totalItems = $('.item-checkbox').length;
    var checkedItems = $('.item-checkbox:checked').length;
    
    if (totalItems === 0) {
      // No items in cart
      $('#selectAll').prop('indeterminate', false).prop('checked', false);
    } else if (checkedItems === 0) {
      // No items checked
      $('#selectAll').prop('indeterminate', false).prop('checked', false);
    } else if (checkedItems === totalItems) {
      // All items checked
      $('#selectAll').prop('indeterminate', false).prop('checked', true);
    } else {
      // Some items checked (indeterminate state)
      $('#selectAll').prop('indeterminate', true).prop('checked', false);
    }
  }
  
  function updateTotal() {
    var total = 0;
    $('.item-checkbox:checked').each(function() {
      var price = parseInt($(this).data('price'));
      var qty = parseInt($(this).data('qty'));
      total += price * qty;
    });
    
    $('#cartTotal').text('Rp' + total.toLocaleString('id-ID'));
  }
  
  function updateRowStyles() {
    $('.item-checkbox').each(function() {
      var row = $(this).closest('tr');
      if ($(this).is(':checked')) {
        row.removeClass('disabled');
      } else {
        row.addClass('disabled');
      }
    });
  }
  
  // Initialize with small delay to ensure DOM is ready
  setTimeout(function() {
    updateSelectAll();
    updateRowStyles();
  }, 100);
});

function proceedToCheckout() {
  var selectedItems = [];
  $('.item-checkbox:checked').each(function() {
    selectedItems.push($(this).data('index'));
  });
  
  if (selectedItems.length === 0) {
    showAlertModal('Pilih minimal satu item untuk checkout!');
    return;
  }
  
  // Store selected items in session storage
  sessionStorage.setItem('selectedCartItems', JSON.stringify(selectedItems));
  
  // Redirect to checkout
  window.location.href = "{{ route('checkout') }}";
}
</script>
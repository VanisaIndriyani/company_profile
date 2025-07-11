@if(count($cart) > 0)
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cart as $item)
        <tr>
          <td>{{ $item['name'] }}</td>
          <td>{{ $item['qty'] }}</td>
          <td>Rp{{ number_format($item['price']) }}</td>
          <td>Rp{{ number_format($item['qty'] * $item['price']) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="text-right">
    <a href="#" class="btn btn-warning" onclick="$('#cartModal').modal('hide');$('#checkoutModal').modal('show');return false;">Lihat Detail & Checkout</a>
  </div>
@else
  <div class="text-center text-muted">Keranjang kosong.</div>
@endif 
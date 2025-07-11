@extends('layouts.user')
@section('content')
<div class="container mt-5">
    <h2>Checkout</h2>
    
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
    
    @if(count($cart) == 0)
        <div class="alert alert-warning">Keranjang kosong.</div>
    @else
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
    @endif
</div>
@endsection 
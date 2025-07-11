@extends('layouts.manager')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Daftar Pesanan</h2>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover bg-white">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No Meja</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Item</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->nama }}</td>
                                        <td>{{ $order->no_meja }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge badge-success">Accepted</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul style="list-style:none; padding-left:0; margin:0;">
                                                @foreach(json_decode($order->items, true) as $item)
                                                    <li style="margin-bottom:8px; border-bottom:1px solid #eee; padding-bottom:6px;">
                                                        <b>{{ $item['name'] }}</b><br>
                                                        Qty: {{ $item['qty'] }}<br>
                                                        Harga: Rp{{ number_format($item['price']) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <form action="{{ route('manager.orders.accept', $order) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm rounded-pill" title="Terima"><i class="fa fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('manager.orders.reject', $order) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill" title="Tolak"><i class="fa fa-times"></i></button>
                                                </form>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
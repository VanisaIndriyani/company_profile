@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Pesan Kontak</h2>
    <form method="GET" class="mb-3">
        <div class="form-row align-items-end">
            <div class="col-md-3 mb-2">
                <label for="search_name">Nama</label>
                <input type="text" name="name" id="search_name" class="form-control" value="{{ request('name') }}" placeholder="Cari nama">
            </div>
            <div class="col-md-3 mb-2">
                <label for="search_email">Email</label>
                <input type="text" name="email" id="search_email" class="form-control" value="{{ request('email') }}" placeholder="Cari email">
            </div>
            <div class="col-md-3 mb-2">
                <label for="search_subject">Subjek</label>
                <input type="text" name="subject" id="search_subject" class="form-control" value="{{ request('subject') }}" placeholder="Cari subjek">
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100" type="submit"><i class="fa fa-search"></i> Cari</button>
            </div>
            <div class="col-md-1 mb-2">
                <a href="{{ route('admin.messages') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </div>
    </form>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Subjek</th>
                <th>Pesan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->subject }}</td>
                <td>{{ $msg->message }}</td>
                <td>{{ $msg->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada pesan.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $messages->links() }}
</div>
@endsection 
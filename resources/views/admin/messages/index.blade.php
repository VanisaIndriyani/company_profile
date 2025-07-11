@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Pesan Kontak</h2>
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
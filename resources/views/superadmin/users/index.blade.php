@extends('layouts.superadmin')
@section('content')
<div class="container mt-5">
    <h2>Manajemen User (Admin & Manager)</h2>
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
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        @if($user->role !== 'super_admin')
                        <form action="{{ route('users.reset_password', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-warning btn-sm" onclick="return confirm('Reset password user ini ke password123?')"><i class="fa fa-key"></i> Reset Password</button>
                        </form>
                        @if(session('reset_user_id') == $user->id)
                        <button type="button" class="btn btn-info btn-sm btn-show-pw" data-pw="{{ session('reset_password') }}"><i class="fa fa-eye"></i> Show</button>
                        <span class="ml-2" id="pw-text-{{ $user->id }}" style="display:none;font-weight:bold;"></span>
                        @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
@push('scripts')
<script>
$(function() {
    $('.btn-show-pw').on('click', function() {
        var pw = $(this).data('pw');
        var uid = '{{ session('reset_user_id') }}';
        var span = $('#pw-text-' + uid);
        if(span.is(':visible')) {
            span.hide();
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            $(this).text(' Show').prepend('<i class="fa fa-eye"></i>');
        } else {
            span.text(pw).show();
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).text(' Hide').prepend('<i class="fa fa-eye-slash"></i>');
        }
    });
});
</script>
@endpush 
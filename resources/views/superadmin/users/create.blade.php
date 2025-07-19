@extends('layouts.superadmin')
@section('content')
<div class="container mt-5">
    <h2>Tambah User (Admin/Karyawan)</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="passwordInput" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fa fa-eye"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                <option value="manager" {{ old('role')=='manager'?'selected':'' }}>Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#togglePassword').on('click', function() {
        var input = $('#passwordInput');
        var icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
@endpush 
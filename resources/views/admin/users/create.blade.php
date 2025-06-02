@extends('layouts.admin')

@section('content')
<div class="min-height-200px">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="mb-4">Tambah User Baru</h4>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                       required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

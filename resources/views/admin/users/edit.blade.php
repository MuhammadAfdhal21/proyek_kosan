@extends('layouts.admin')

@section('content')
<div class="min-height-200px">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="mb-4">Edit User</h4>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection

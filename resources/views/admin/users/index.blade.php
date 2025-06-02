@extends('layouts.admin') {{-- misal layout admin kamu namanya admin.blade.php --}}

@section('content')
<h2>Daftar User</h2>

<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kosan</h1>

    <form action="{{ route('admin.kosan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kosan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

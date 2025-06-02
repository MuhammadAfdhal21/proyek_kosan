@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Kosan</h1>

    <form action="{{ route('admin.kosan.update', $kosan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $kosan->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $kosan->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $kosan->harga }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kosan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

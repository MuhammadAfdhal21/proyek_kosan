@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Kosan</h1>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $kosan->nama }}
    </div>
    <div class="mb-3">
        <strong>Alamat:</strong> {{ $kosan->alamat }}
    </div>
    <div class="mb-3">
        <strong>Harga:</strong> Rp {{ number_format($kosan->harga) }}
    </div>

    <a href="{{ route('admin.kosan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection

@extends('layouts.penyewa')
@section('title', 'Cari Kosan')

@section('content')
<div class="container py-5">
    <!-- Panel Heading -->
    <div class="bg-light p-4 rounded-3 shadow-sm mb-5 border">
        <h2 class="fw-bold mb-0 text-center text-dark">Daftar Kosan Tersedia</h2>
        <p class="text-center text-muted mt-2 mb-0">Pilih tempat tinggal yang nyaman sesuai kebutuhan Anda</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm text-center">{{ session('success') }}</div>
    @endif

    <!-- List Kosan -->
    <div class="row g-4">
        @forelse($kosan as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow h-100 rounded-4 overflow-hidden">
                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/kost.jpg') }}" class="card-img-top" alt="Foto Kost" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-semibold text-primary">{{ $item->nama }}</h5>
                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-geo-alt-fill me-1"></i> {{ $item->alamat }}
                    </p>
                    <p class="card-text fs-6 fw-bold text-success mb-4">
                        Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan
                    </p>
                    <a href="{{ route('penyewa.kost.detail', $item->id) }}" class="btn btn-outline-primary mt-auto w-100 rounded-pill">
                        <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Tidak ada kosan tersedia saat ini.</div>
        </div>
        @endforelse
    </div>

    @if ($kosan->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $kosan->links() }}
    </div>
    @endif
</div>
@endsection

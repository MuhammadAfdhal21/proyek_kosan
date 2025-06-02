@extends('layouts.penyewa')

@section('title', $kost->nama)

@section('content')
<div class="container py-5">
    <!-- Judul Kost -->
    <div class="mb-5 text-center">
        <h2 class="fw-bold text-primary">{{ $kost->nama }}</h2>
        <p class="text-muted mt-2">Detail lengkap tentang kosan ini</p>
    </div>

    <div class="row g-4">
        <!-- Kolom Deskripsi -->
        <div class="col-md-8">
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4">

            {{-- Gambar Kost --}}
            @if($kost->gambar)
                <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Gambar Kost"
                    class="img-fluid rounded-4 mb-4 shadow-sm"
                    style="max-height: 300px; width: 100%; object-fit: cover;">
            @endif

            <h5 class="card-title fw-semibold text-dark mb-3">Informasi Kost</h5>
            <ul class="list-unstyled text-secondary fs-6">
                <li class="mb-2"><strong>Alamat:</strong> {{ $kost->alamat }}</li>
                <li class="mb-2"><strong>Fasilitas:</strong> {{ $kost->fasilitas }}</li>
                <li class="mb-2">
                    <strong>Harga:</strong>
                    <span class="text-success fw-bold">Rp{{ number_format($kost->harga, 0, ',', '.') }}/bulan</span>
                </li>
            </ul>
            <hr>
            <h6 class="fw-bold text-dark mb-2">Deskripsi:</h6>
            <p class="text-secondary">{{ $kost->deskripsi }}</p>

            <div class="mt-4 text-end">
                <a href="{{ route('penyewa.transaksi.sewa', $kost->id) }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                    <i class="fas fa-door-open me-2"></i> Sewa Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

        <!-- Kolom Peta -->
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-3">Lokasi Kost</h5>
                    <div class="map-responsive">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($kost->alamat) }}&output=embed"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .map-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }

    .map-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
    }
</style>
@endpush

@extends('layouts.pemilik') <!-- Pastikan layout ini sudah kamu buat -->
@section('title', 'Dashboard Pemilik')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Selamat Datang, {{ Auth::user()->name }}</h3>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Kosan</h5>
                    <p class="fs-4 fw-bold">{{ $jumlahKosan }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Penyewa Aktif</h5>
                    <p class="fs-4 fw-bold">{{ $jumlahPenyewa }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Transaksi Bulan Ini</h5>
                    <p class="fs-4 fw-bold">{{ $jumlahTransaksiBulanIni }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Transaksi Pending</h5>
                    <p class="fs-4 fw-bold">{{ $transaksiPending }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card border-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pendapatan Bulanan</h5>
                    <p class="fs-4 fw-bold">Rp {{ number_format($pendapatanBulanan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

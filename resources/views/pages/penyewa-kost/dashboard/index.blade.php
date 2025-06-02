@extends('layouts.penyewa')

@section('title', 'Dashboard Penyewa')

@section('content')
    <h3 class="mb-4 fw-bold text-primary">Halo, {{ Auth::user()->name }}</h3>

    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning shadow-sm rounded-4 position-relative">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Pending</h5>
                        <h2 class="fw-bold">{{ $jumlahPending }}</h2>
                    </div>
                    <i class="bi bi-clock-history fs-1 opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success shadow-sm rounded-4 position-relative">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Diterima</h5>
                        <h2 class="fw-bold">{{ $jumlahDiterima }}</h2>
                    </div>
                    <i class="bi bi-check-circle fs-1 opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger shadow-sm rounded-4 position-relative">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Ditolak</h5>
                        <h2 class="fw-bold">{{ $jumlahDitolak }}</h2>
                    </div>
                    <i class="bi bi-x-circle fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3 fw-semibold">Transaksi Terbaru</h4>
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="table-primary">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Nama Kosan</th>
                    <th style="width: 25%;">Tanggal Transaksi</th>
                    <th style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
    @forelse($transaksis->take(5) as $index => $transaksi)
        <tr>
            <td>{{ $index + 1 }}</td>  {{-- Nomor urut 1-5 --}}
            <td class="fw-semibold text-primary">{{ $transaksi->kosan->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
            <td>
                @if($transaksi->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($transaksi->status == 'diterima')
                    <span class="badge bg-success">Diterima</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center text-muted fst-italic">Belum ada transaksi.</td></tr>
    @endforelse
</tbody>

        </table>
    </div>

@endsection

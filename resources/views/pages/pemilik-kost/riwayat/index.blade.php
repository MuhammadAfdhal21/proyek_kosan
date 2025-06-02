@extends('layouts.pemilik')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-primary">Riwayat Transaksi Kost</h2>

    @if ($transaksis->isEmpty())
        <div class="alert alert-info text-center fs-5">
            <i class="bi bi-info-circle me-2"></i> Belum ada transaksi.
        </div>
    @else
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-primary text-white" style="position: sticky; top: 0; z-index: 10;">
                            <tr>
                                <th style="width: 5%;" class="text-center py-3">No</th>
                                <th class="py-3">Nama Kos</th>
                                <th style="width: 18%;" class="text-center py-3">Tanggal</th>
                                <th style="width: 18%;" class="text-center py-3">Status</th>
                                <th style="width: 15%;" class="text-end py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $trx)
                            <tr style="border-bottom: 1px solid #e9ecef;"
                                class="@if($trx->status == 'diterima') bg-success bg-opacity-10
                                       @elseif($trx->status == 'pending') bg-warning bg-opacity-10
                                       @else bg-secondary bg-opacity-10 @endif">
                                <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-primary">{{ $trx->kosan->nama ?? '-' }}</td>
                                <td class="text-center text-muted">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if ($trx->status == 'diterima')
                                        <span class="badge rounded-pill bg-success px-3 py-2 fs-6">
                                            <i class="bi bi-check-circle me-2"></i> Berhasil
                                        </span>
                                    @elseif ($trx->status == 'pending')
                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2 fs-6">
                                            <i class="bi bi-clock me-2"></i> Menunggu
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary px-3 py-2 fs-6">
                                            {{ ucfirst($trx->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold text-dark">Rp{{ number_format($trx->kosan->harga ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

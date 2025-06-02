@extends('layouts.penyewa')
@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container">
    <h3 class="mb-4">Riwayat Transaksi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Kosan</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kosan->nama ?? '-' }}</td>
                <td>{{ $item->tanggal_transaksi }}</td>
                <td>
                    <span class="badge
                        @if(strtolower($item->status) === 'pending') bg-warning
                        @elseif(strtolower($item->status) === 'diterima') bg-success
                        @else bg-danger @endif">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    @if(strtolower($item->status) === 'pending')
                        <a href="{{ route('bayar.form', $item->id) }}" class="btn btn-sm btn-success">Bayar</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada riwayat transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.pemilik') {{-- pastikan layout ini ada --}}
@section('title', 'Data Transaksi')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Data Transaksi Penyewa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kosan</th>
                <th>Nama Penyewa</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Aksi</th> {{-- kolom untuk tombol update --}}
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->id }}</td>
                <td>{{ $transaksi->kosan->nama ?? '-' }}</td>
                <td>{{ $transaksi->user->name ?? '-' }}</td>
                <td>{{ $transaksi->tanggal_transaksi }}</td>
                <td>
                    {{-- Form update status --}}
                    <form action="{{ route('pemilik.transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diterima" {{ $transaksi->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ $transaksi->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                </td>
                <td>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

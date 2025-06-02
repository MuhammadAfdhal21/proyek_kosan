@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Pengguna</th>
                <th>Kosan</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ $transaksi->kosan->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</td>
                    <td>
                        @if($transaksi->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($transaksi->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.transaksi.show', $transaksi->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus transaksi ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

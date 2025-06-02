@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Data Kosan</h1>

    <a href="{{ route('admin.kosan.create') }}" class="btn btn-primary mb-3">+ Tambah Kosan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Harga</th>
                <th>Fasilitas</th>
                <th>Deskripsi</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kosans as $kosan)
                <tr>
                    <td>{{ $kosan->nama }}</td>
                    <td>{{ $kosan->alamat }}</td>
                    <td>Rp {{ number_format($kosan->harga, 0, ',', '.') }}</td>
                    <td>{{ $kosan->fasilitas }}</td>
                    <td>{{ Str::limit($kosan->deskripsi, 80) }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Aksi Kosan">
                            <a href="{{ route('admin.kosan.show', $kosan->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.kosan.edit', $kosan->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.kosan.destroy', $kosan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data kosan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

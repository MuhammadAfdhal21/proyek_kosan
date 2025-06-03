@extends('layouts.pemilik')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>Daftar Kost</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Kost</button>
        </div>

        {{-- Modal Tambah Kost --}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('pemilik.kost.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Kost</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama Kost</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Fasilitas</label>
                                <textarea name="fasilitas" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse ($kosts as $kost)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            @if($kost->gambar)
                                <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Gambar Kost" class="img-fluid rounded mb-3" style="height: 180px; object-fit: cover; width: 100%;">
                            @else
                                <img src="{{ asset('images/kost.jpg') }}" alt="Default Gambar" class="img-fluid rounded mb-3" style="height: 180px; object-fit: cover; width: 100%;">
                            @endif

                            <h5 class="card-title">{{ $kost->nama }}</h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> {{ $kost->alamat }}<br>
                                <strong>Fasilitas:</strong> {{ $kost->fasilitas }}<br>
                                <strong>Harga:</strong> Rp{{ number_format($kost->harga, 0, ',', '.') }}
                            </p>
                            <p class="card-text">{{ Str::limit($kost->deskripsi, 100) }}</p>

                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $kost->id }}">Edit</button>

                                <form action="{{ route('pemilik.kost.destroy', $kost->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kost ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Edit --}}
                <div class="modal fade" id="editModal{{ $kost->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kost->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('pemilik.kost.update', $kost->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $kost->id }}">Edit Kost - {{ $kost->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama Kost</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $kost->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" required>{{ $kost->alamat }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Fasilitas</label>
                                        <textarea name="fasilitas" class="form-control" required>{{ $kost->fasilitas }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" value="{{ $kost->harga }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control">{{ $kost->deskripsi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Gambar (opsional)</label>
                                        <input type="file" name="gambar" class="form-control">
                                        @if($kost->gambar)
                                            <small class="text-muted">Gambar saat ini: {{ $kost->gambar }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada data kost tersedia.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $kosts->links() }}
        </div>
    </div>
@endsection

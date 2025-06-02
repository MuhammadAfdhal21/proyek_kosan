@extends('layouts.pemilik')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between">
            <div>
                <h3>Daftar Kost</h3>
            </div>
            <div>
                <!-- Tombol Tambah -->
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Kost</button>

                <!-- Modal Tambah Kost -->
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
                                @include('pages.pemilik-kost.data-kost.form')
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($kosts as $kost)
                <div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm">
        <div class="card-body">
            @if($kost->gambar)
                <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Gambar Kost {{ $kost->nama }}" class="img-fluid rounded mb-3" style="height: 180px; width: 100%; object-fit: cover;">
            @else
                <img src="{{ asset('images/kost.jpg') }}" alt="Gambar Default Kost" class="img-fluid rounded mb-3" style="height: 180px; width: 100%; object-fit: cover;">
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

                <form action="{{ route('pemilik.kost.destroy', $kost->id) }}" method="POST" onsubmit="return confirm('Hapus kost ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>

            <!-- Modal Edit Kost (tetap sama) -->
        </div>
    </div>
</div>

            @empty
                <div class="col-12">
                    <div class="alert alert-info">
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

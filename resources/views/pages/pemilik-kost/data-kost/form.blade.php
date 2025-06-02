<form action="{{ isset($kost) ? route('pemilik.kost.update', $kost->id) : route('pemilik.kost.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $kost->nama ?? '') }}" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $kost->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Fasilitas</label>
        <textarea name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" required>{{ old('fasilitas', $kost->fasilitas ?? '') }}</textarea>
        @error('fasilitas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
               value="{{ old('harga', $kost->harga ?? '') }}" required>
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kost->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Kosan</label>
        <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" accept="image/*">
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if (isset($kost) && $kost->gambar)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Gambar Kosan" class="img-thumbnail" style="max-height: 150px;">
            </div>
        @endif
    </div>
<button type="submit" class="btn btn-primary">SIMPAN DATA KOSAN</button>
</form>

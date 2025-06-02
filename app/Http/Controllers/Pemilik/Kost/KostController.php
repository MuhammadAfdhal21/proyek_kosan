<?php

namespace App\Http\Controllers\Pemilik\Kost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;  // Pastikan model Kost sudah ada dan namespace benar
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
        public function index()
    {
        // Ambil data kosan milik pemilik yang login (jika ada filter pemilik)
        $kosts = Kosan::paginate(10);
        return view('pages.pemilik-kost.data-kost.index', compact('kosts'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'fasilitas' => 'required|string',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('kost', 'public');
        $validated['gambar'] = $path;
    }

    // Tambahkan ID pemilik dari user yang login
    $validated['pemilik_kosan_id'] = auth()->user()->id;

    Kosan::create($validated);

    return redirect()->route('pemilik.kost.index')->with('success', 'Data kost berhasil disimpan.');
}

    public function update(Request $request, $id)
    {
        $kost = Kosan::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'fasilitas' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Jika upload gambar baru, hapus gambar lama lalu simpan gambar baru
        if ($request->hasFile('gambar')) {
            if ($kost->gambar && Storage::disk('public')->exists($kost->gambar)) {
                Storage::disk('public')->delete($kost->gambar);
            }

            $path = $request->file('gambar')->store('kost', 'public');
            $validated['gambar'] = $path;
        }

        // Update data kost
        $kost->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('pemilik.kost.index')->with('success', 'Data kost berhasil diupdate.');
    }
}

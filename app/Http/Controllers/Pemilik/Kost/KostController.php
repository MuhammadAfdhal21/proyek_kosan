<?php

namespace App\Http\Controllers\Pemilik\Kost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    public function index()
    {
        $pemilik = auth()->user()->pemilik_kosan;

        if (!$pemilik) {
            return redirect()->back()->with('error', 'Data pemilik tidak ditemukan.');
        }

        $kosts = Kosan::where('pemilik_kosan_id', $pemilik->id)->latest()->paginate(6);

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

        $validated['pemilik_kosan_id'] = auth()->user()->pemilik_kosan->id ?? null;

        if (!$validated['pemilik_kosan_id']) {
            return redirect()->back()->with('error', 'Data pemilik tidak ditemukan. Silakan lengkapi profil terlebih dahulu.');
        }

        Kosan::create($validated);

        return redirect()->route('pemilik.kost.index')->with('success', 'Data kost berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $kost = Kosan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'fasilitas' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kost->gambar && Storage::disk('public')->exists($kost->gambar)) {
                Storage::disk('public')->delete($kost->gambar);
            }

            $path = $request->file('gambar')->store('kost', 'public');
            $validated['gambar'] = $path;
        }

        $kost->update($validated);

        return redirect()->route('pemilik.kost.index')->with('success', 'Data kost berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kost = Kosan::findOrFail($id);

        if ($kost->gambar && Storage::disk('public')->exists($kost->gambar)) {
            Storage::disk('public')->delete($kost->gambar);
        }

        $kost->delete();

        return redirect()->route('pemilik.kost.index')->with('success', 'Data kost berhasil dihapus.');
    }
}

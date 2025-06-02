<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kosan;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['user', 'kosan'])->latest()->get();
        return view('pemilik-kost.transaksi.index', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'kosan'])->findOrFail($id);
        return view('pemilik-kost.transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with(['user', 'kosan'])->findOrFail($id);
        return view('pemilik.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->route('pemilik.transaksi.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('pemilik.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

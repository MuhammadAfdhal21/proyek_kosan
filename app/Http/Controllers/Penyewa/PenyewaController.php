<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil transaksi penyewa terbaru 5 data
        $transaksis = Transaksi::with('kosan')
            ->where('user_id', $userId)
            ->orderBy('tanggal_transaksi', 'desc')
            ->limit(5)
            ->get();

        // Hitung jumlah transaksi berdasarkan status
        $jumlahPending = Transaksi::where('user_id', $userId)->where('status', 'pending')->count();
        $jumlahDiterima = Transaksi::where('user_id', $userId)->where('status', 'diterima')->count();
        $jumlahDitolak = Transaksi::where('user_id', $userId)->where('status', 'ditolak')->count();

        return view('pages.penyewa-kost.dashboard.index', compact(
            'transaksis',
            'jumlahPending',
            'jumlahDiterima',
            'jumlahDitolak'
        ));
    }

    public function lihatKost()
    {
        $kosan = Kosan::latest()->simplePaginate(6);
        return view('pages.penyewa-kost.kosan.index', compact('kosan'));
    }

    public function detailKost($id)
    {
        $kost = Kosan::findOrFail($id);
        return view('pages.penyewa-kost.kosan.detail', compact('kost'));
    }

   public function sewaKost($id)
{
    $kost = Kosan::findOrFail($id);

    $transaksi = Transaksi::create([
        'user_id' => auth()->id(),
        'kosan_id' => $kost->id,
        'tanggal_transaksi' => Carbon::now()->toDateString(),
        'status' => 'pending',
    ]);

    // Redirect ke halaman bayar Midtrans, misal route sewa.midtrans
    return redirect()->route('penyewa.sewa.midtrans', $transaksi->id)
        ->with('success', 'Kost berhasil disewa! Silakan lakukan pembayaran.');
}

    public function riwayat()
{
    $transaksis = Transaksi::with('kosan')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('pages.penyewa-kost.riwayat.riwayat', compact('transaksis'));
}
    public function formBayar($id)
    {
        $transaksi = Transaksi::with('kosan')->where('user_id', auth()->id())->findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return redirect()->route('penyewa.riwayat')->with('error', 'Transaksi tidak valid.');
        }

        return view('pages.penyewa-kost.riwayat.bayar', compact('transaksi'));
    }

    public function bayar(Request $request, $id)
    {
        $transaksi = Transaksi::where('user_id', auth()->id())->findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return redirect()->route('penyewa.riwayat')->with('error', 'Transaksi tidak bisa dibayar.');
        }

        // Simulasi pembayaran
        $transaksi->status = 'diterima'; // misal otomatis diterima setelah pembayaran
        $transaksi->save();

        return redirect()->route('penyewa.riwayat')->with('success', 'Pembayaran berhasil!');
    }
}

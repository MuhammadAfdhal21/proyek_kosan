<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilikId = Auth::user()->pemilik_kosan->id ?? null;

        // Jika pemilik belum punya relasi, redirect
        if (!$pemilikId) {
            return redirect()->back()->with('error', 'Data pemilik tidak ditemukan.');
        }

        // Ambil semua kosan milik pemilik tersebut
        $kosanIds = Kosan::where('pemilik_kosan_id', $pemilikId)->pluck('id');

        // 1. Jumlah kosan milik pemilik
        $jumlahKosan = $kosanIds->count();

        // 2. Jumlah penyewa aktif (distinct user_id yang status transaksinya 'diterima')
        $jumlahPenyewa = Transaksi::whereIn('kosan_id', $kosanIds)
            ->where('status', 'diterima')
            ->distinct('user_id')
            ->count('user_id');

        // 3. Jumlah transaksi bulan ini
        $bulanIni = Carbon::now()->format('Y-m');
        $jumlahTransaksiBulanIni = Transaksi::whereIn('kosan_id', $kosanIds)
            ->where('status', 'diterima')
            ->where('tanggal_transaksi', 'like', "$bulanIni%")
            ->count();

        // 4. Total pendapatan bulan ini (jumlah dari kosans.harga yang dikaitkan dengan transaksi yang diterima)
        $pendapatanBulanan = DB::table('transaksis')
            ->join('kosans', 'transaksis.kosan_id', '=', 'kosans.id')
            ->whereIn('transaksis.kosan_id', $kosanIds)
            ->where('transaksis.status', 'diterima')
            ->where('transaksis.tanggal_transaksi', 'like', "$bulanIni%")
            ->sum('kosans.harga');

        // 5. Jumlah transaksi pending
        $transaksiPending = Transaksi::whereIn('kosan_id', $kosanIds)
            ->where('status', 'pending')
            ->count();

        return view('pages.pemilik-kost.dashboard.index', compact(
            'jumlahKosan',
            'jumlahPenyewa',
            'jumlahTransaksiBulanIni',
            'pendapatanBulanan',
            'transaksiPending'
        ));
    }
}

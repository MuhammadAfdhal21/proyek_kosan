<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class RiwayatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua transaksi yang berkaitan dengan pemilik kost
        $transaksis = Transaksi::whereHas('kosan', function ($query) use ($userId) {
            $query->where('user_id', $userId); // asumsi kolom user_id di tabel kost adalah ID pemilik
        })->latest()->get();

        return view('pages.pemilik-kost.riwayat.index', compact('transaksis'));
    }
}


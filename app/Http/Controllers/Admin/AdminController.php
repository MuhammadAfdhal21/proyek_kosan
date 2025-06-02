<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kosan;
use App\Models\Transaksi;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalKosan = Kosan::count();
        $totalTransaksi = Transaksi::count();

        return view('pages.admin.dashboard.index', compact('totalUsers', 'totalKosan', 'totalTransaksi'));
    }
}

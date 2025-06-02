<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalKosan = Kosan::count();
    $totalTransaksi = Transaksi::count();

    return view('admin.dashboard', compact('totalUsers', 'totalKosan', 'totalTransaksi'));
}
}

<?php


use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KosanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Pemilik\Kost\KostController;
use App\Http\Controllers\Penyewa\PenyewaController;
use App\Http\Controllers\Penyewa\TransaksiController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Pemilik\RiwayatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
// ========== Auth ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ========== Admin ==========
Route::middleware(['auth', 'users:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/kosan', KosanController::class);
    Route::resource('/transaksi', TransaksiController::class);
});


// ========== Pemilik ==========
Route::prefix('pemilik')->middleware(['auth', 'users:pemilik'])->name('pemilik.')->group(function () {
    // Dashboard Pemilik
    Route::get('/dashboard', [PemilikController::class, 'index'])->name('dashboard');

    // CRUD Kosan
    Route::get('/kost', [KostController::class, 'index'])->name('kost.index');
    Route::post('/kost/store', [KostController::class, 'store'])->name('kost.store');
    Route::put('/kost/update/{id}', [KostController::class, 'update'])->name('kost.update');
    Route::delete('/kost/delete/{id}', [KostController::class, 'destroy'])->name('kost.destroy');

    // Transaksi
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

Route::middleware(['auth', 'users:pemilik'])->group(function () {
    Route::get('/pemilik/transaksi', [RiwayatController::class, 'index'])->name('pemilik.transaksi.index');
    Route::get('/riwayat', [\App\Http\Controllers\Pemilik\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

// ========== Penyewa ==========
// ========== Penyewa ==========
Route::prefix('penyewa')->middleware(['auth', 'users:penyewa'])->name('penyewa.')->group(function () {
    Route::get('/dashboard', [PenyewaController::class, 'index'])->name('dashboard');

    Route::get('/kost', [PenyewaController::class, 'lihatKost'])->name('kost.index');
    Route::get('/kost/{id}', [PenyewaController::class, 'detailKost'])->name('kost.detail');

    // Transaksi dengan Midtrans (otomatis)
    Route::get('/sewa/{id}', [TransaksiController::class, 'sewa'])->name('transaksi.sewa');

    // Riwayat Transaksi
    Route::get('/riwayat', [PenyewaController::class, 'riwayat'])->name('riwayat');
});

Route::post('/midtrans/callback', [MidtransController::class, 'notificationHandler']);


    Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('penyewa.riwayat');
    Route::get('/bayar-ulang/{id}', [TransaksiController::class, 'bayarUlang'])->name('penyewa.bayar_ulang');


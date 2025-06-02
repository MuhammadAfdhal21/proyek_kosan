<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Transaksi;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function notificationHandler(Request $request)
{
    $data = $request->all(); // gunakan langsung request, bukan Notification()

    $order_id = $data['order_id'];
    $transaction_status = $data['transaction_status'];
    $fraud_status = $data['fraud_status'] ?? 'accept';

    $transaksi = Transaksi::where('order_id', $order_id)->first();

    if (!$transaksi) {
        return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
    }

if ($transaction_status == 'capture') {
    // Capture biasanya untuk kartu kredit, cek fraud status
    $transaksi->status = ($fraud_status == 'accept') ? 'diterima' : 'pending';
} elseif ($transaction_status == 'settlement') {
    $transaksi->status = 'diterima';
} elseif ($transaction_status == 'pending') {
    $transaksi->status = 'pending';
} elseif ($transaction_status == 'deny') {
    $transaksi->status = 'ditolak';
} elseif ($transaction_status == 'expire') {
    $transaksi->status = 'ditolak'; // Karena sudah expire, dianggap gagal
} elseif ($transaction_status == 'cancel') {
    $transaksi->status = 'ditolak'; // Pembayaran dibatalkan, dianggap gagal
}


    $transaksi->save();

    return response()->json(['message' => 'Notifikasi berhasil diproses']);
}
}

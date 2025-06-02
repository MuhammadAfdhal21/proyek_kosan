<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kosan;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class TransaksiController extends Controller
{
    public function sewa($id)
    {
        $kost = Kosan::findOrFail($id);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $order_id = 'TRX-' . uniqid();

        $transaksi = Transaksi::create([
            'user_id'           => auth()->id(),
            'kosan_id'          => $kost->id,
            'order_id'          => $order_id,
            'status'            => 'pending',
            'tanggal_transaksi' => now(), // Tambahkan ini
        ]);

        $params = [
            'transaction_details' => [
                'order_id'     => $order_id,
                'gross_amount' => $kost->harga,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ],
            'callbacks' => [
                'finish' => route('penyewa.riwayat'),
            ],
            'notification_url' => 'https://06b0-180-245-28-199.ngrok-free.app/midtrans/callback',
        ];


        $snapToken = Snap::getSnapToken($params);

        $transaksi->snap_token = $snapToken;
        $transaksi->save();

        return view('pages.penyewa-kost.transaksi.bayar_midtrans', compact('transaksi', 'kost', 'snapToken'));
    }

    public function riwayat()
{
    $transaksis = Transaksi::with('kosan')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('pages.penyewa-kost.riwayat.riwayat', compact('transaksis'));
}

}

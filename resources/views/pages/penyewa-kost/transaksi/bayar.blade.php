@extends('layouts.penyewa') {{-- Ganti jika kamu pakai layout lain --}}

@section('title', 'Pembayaran Kost')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Pembayaran Sewa Kost</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama Kost:</strong> {{ $kost->nama_kosan }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($kost->harga, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>

            <hr>

            <div id="snap-container">
                <p>Mohon tunggu, Anda akan diarahkan ke halaman pembayaran...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('penyewa.riwayat') }}";
            },
            onPending: function(result) {
                alert("Pembayaran sedang diproses. Anda akan diarahkan ke riwayat.");
                window.location.href = "{{ route('penyewa.riwayat') }}";
            },
            onError: function(result) {
                alert("Terjadi kesalahan saat pembayaran.");
                console.error(result);
            },
            onClose: function() {
                alert("Anda menutup halaman pembayaran.");
            }
        });
    });
</script>
@endsection

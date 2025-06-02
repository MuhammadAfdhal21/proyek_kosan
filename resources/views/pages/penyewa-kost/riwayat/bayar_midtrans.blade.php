@extends('layouts.penyewa') {{-- Ganti dengan layout milikmu jika berbeda --}}

@section('title', 'Pembayaran Kost')

@section('content')
<div class="container mt-4">
    <h3>Pembayaran Kost: {{ $kost->nama_kosan }}</h3>
    <p><strong>Harga:</strong> Rp{{ number_format($kost->harga, 0, ',', '.') }}</p>
    <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>

    <hr>
    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                window.location.href = "{{ route('penyewa.riwayat') }}";
            },
            onPending: function(result) {
                alert("Pembayaran tertunda.");
                console.log(result);
                window.location.href = "{{ route('penyewa.riwayat') }}";
            },
            onError: function(result) {
                alert("Terjadi kesalahan saat pembayaran.");
                console.log(result);
            },
            onClose: function() {
    console.log('Popup pembayaran ditutup tanpa menyelesaikan.');
    // Tidak redirect, tidak alert
}
        });
    });
</script>
@endsection

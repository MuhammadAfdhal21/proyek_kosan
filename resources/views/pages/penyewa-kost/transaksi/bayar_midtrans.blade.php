@extends('layouts.penyewa')

@section('title', 'Pembayaran Kost')

@section('content')
<div class="container py-4">
    <div class="card mx-auto shadow-lg border-0 rounded-4" style="max-width: 600px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('images/kost.jpg') }}" class="rounded shadow-sm mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                <h2 class="fw-bold">Pembayaran Kost</h2>
                <p class="text-muted">Silakan selesaikan pembayaran Anda</p>
            </div>

            <hr>

            <div class="mb-3 d-flex justify-content-between">
                <span class="fw-semibold">Nama Kost:</span>
                <span>{{ $kost->nama }}</span>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <span class="fw-semibold">Harga:</span>
                <span class="text-success fw-bold">Rp{{ number_format($kost->harga, 0, ',', '.') }}</span>
            </div>
            <div class="mb-4 d-flex justify-content-between">
                <span class="fw-semibold">Order ID:</span>
                <span>{{ $transaksi->order_id }}</span>
            </div>

            <div class="text-center">
                <button id="pay-button" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                    <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('Success:', result);
                window.location.href = "{{ route('penyewa.riwayat') }}";
            },
            onPending: function(result) {
                console.log('Pending:', result);
            },
            onError: function(result) {
                console.log('Error:', result);
            },
            onClose: function() {
                alert('Transaksi belum selesai');
            }
        });
    });
</script>
@endsection

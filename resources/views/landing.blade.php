<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Landing Page - Aplikasi Kosan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap seperti yang digunakan di DeskApp --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- Icon (seperti di DeskApp) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background: #1b00ff;
            color: white;
        }
        .hero {
            background: linear-gradient(to right, #1b00ff, #4e00e0);
            color: white;
            padding: 100px 0;
        }
        .fitur-box {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- HEADER ala DeskApp -->
    <nav class="navbar navbar-expand-lg header py-3 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#">🛏️ Aplikasi Kosan</a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Temukan Kosan Terbaik di Sekitarmu</h1>
            <p class="lead mb-4">Cari, lihat, dan sewa kosan secara praktis dengan fitur lengkap.</p>
            <a href="{{ route('login') }}" class="btn btn-light btn-lg text-primary fw-bold">
                Mulai Sekarang <i class="bi bi-arrow-right-circle ms-2"></i>
            </a>
        </div>
    </section>

    <!-- FITUR -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="fitur-box text-center">
                        <i class="bi bi-search fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold">Pencarian Cepat</h5>
                        <p class="text-muted">Cari kosan berdasarkan lokasi, harga, dan fasilitas dengan mudah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fitur-box text-center">
                        <i class="bi bi-card-image fs-1 text-success mb-3"></i>
                        <h5 class="fw-semibold">Detail Lengkap</h5>
                        <p class="text-muted">Lihat foto, harga, dan fasilitas kosan secara menyeluruh.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fitur-box text-center">
                        <i class="bi bi-people fs-1 text-warning mb-3"></i>
                        <h5 class="fw-semibold">Pemilik & Penyewa</h5>
                        <p class="text-muted">Fitur untuk pemilik kos mengelola data dan penyewa melihat info terbaru.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; {{ date('Y') }} Aplikasi Kosan - All Rights Reserved.
    </footer>

    {{-- Bootstrap JS (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

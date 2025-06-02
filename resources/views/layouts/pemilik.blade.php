<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik Kost</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional custom style -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 1rem;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h5 class="text-white mb-4">Pemilik Kost</h5>
            <a href="{{ route('pemilik.dashboard') }}" class="{{ request()->is('pemilik/dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('pemilik.kost.index') }}" class="{{ request()->is('pemilik/kost*') ? 'active' : '' }}">Data Kosan</a>
            <a href="{{ route('pemilik.riwayat.index') }}" class="{{ request()->is('pemilik/transaksi*') ? 'active' : '' }}">Transaksi</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

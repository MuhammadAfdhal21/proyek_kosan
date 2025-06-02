<!-- resources/views/layouts/admin-navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kost.index') ? 'active' : '' }}" href="{{ route('admin.kost.index') }}">Kost</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.transaksi.index') ? 'active' : '' }}" href="{{ route('admin.transaksi.index') }}">Transaksi</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

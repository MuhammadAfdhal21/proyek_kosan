<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('penyewa.dashboard') }}">Kosan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penyewa.dashboard') ? 'active' : '' }}"
                        href="{{ route('penyewa.dashboard') }}">Beranda</a>
                </li>

                {{-- Lihat Kost --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penyewa.kost.index') ? 'active' : '' }}"
                        href="{{ route('penyewa.kost.index') }}">Lihat Kost</a>
                </li>

                {{-- Riwayat --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penyewa.riwayat') ? 'active' : '' }}"
                        href="{{ route('penyewa.riwayat') }}">Riwayat Sewa</a>
                </li>

                {{-- Profil --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penyewa.profil') ? 'active' : '' }}"
                        href="{{ route('penyewa.profil') }}">Profil</a>
                </li> --}}

                {{-- Logout --}}
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link btn btn-link text-white text-decoration-none"
                            type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

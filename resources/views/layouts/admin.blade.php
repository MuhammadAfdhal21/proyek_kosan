<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aplikasi Kosan</title>

    <!-- DeskApp CSS -->
    <link rel="stylesheet" href="{{ asset('deskapp/vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('deskapp/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('deskapp/vendors/styles/style.css') }}">
</head>
<body>

    <!-- Sidebar -->
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('deskapp/vendors/images/logo.png') }}" alt="" class="dark-logo">
                <img src="{{ asset('deskapp/vendors/images/logo-white.png') }}" alt="" class="light-logo">
            </a>
            
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <!-- Sidebar -->
<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('deskapp/vendors/images/logo.png') }}" alt="" class="dark-logo">
            <img src="{{ asset('deskapp/vendors/images/logo-white.png') }}" alt="" class="light-logo">
        </a>
        
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user"></span><span class="mtext">Manajemen User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kosan.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-building"></span><span class="mtext">Data Kosan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.transaksi.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-invoice"></span><span class="mtext">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-toggle no-arrow"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="micon dw dw-logout"></span><span class="mtext">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Header -->
<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Cari sesuatu...">
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ asset('deskapp/vendors/images/photo1.jpg') }}" alt="">
                    </span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    {{-- <a class="dropdown-item" href="{{ route('profile') }}"><i class="dw dw-user1"></i> Profil</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="dw dw-logout"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search" data-toggle="header_search"></div>
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="Cari sesuatu...">
                    </div>
                </form>
            </div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('deskapp/vendors/images/photo1.jpg') }}" alt="">
                        </span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="dw dw-user1"></i> Profil</a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="dw dw-logout"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="main-container">
        <div class="pd-ltr-20">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('deskapp/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/layout-settings.js') }}"></script>
</body>
</html>

@extends('layouts.admin')

@section('content')
<!-- HEADER -->
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here">
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="/vendors/images/img.jpg" alt="">
                                <h3>John Doe</h3>
                                <p>Selamat datang di dashboard admin!</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="/vendors/images/photo1.jpg" alt="">
                    </span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    {{--<a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="dw dw-user1"></i> Profil</a>--}}
                    <a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> Pengaturan</a>
                    <a class="dropdown-item" href="#"><i class="dw dw-help"></i> Bantuan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit"><i class="dw dw-logout"></i> Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DASHBOARD CONTENT -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card-box pd-20 text-white mb-4 bg-primary">
                <h4 class="font-18">Total User</h4>
                <h2 class="text-white">{{ $totalUsers }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box pd-20 text-white mb-4 bg-success">
                <h4 class="font-18">Total Kost</h4>
                <h2 class="text-white">{{ $totalKosan }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box pd-20 text-white mb-4 bg-warning">
                <h4 class="font-18">Total Transaksi</h4>
                <h2 class="text-white">{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection

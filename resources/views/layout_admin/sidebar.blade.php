<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="../../assets/img/Logo_SMK.png" width="26px" height="26px" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">SMA GITA KIRTI 2</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard_admin') ? 'active' : '' }}"
                    href="{{ route('dashboard_admin') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Halaman Utama</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('siswas.index') ? 'active' : '' }}"
                    href="{{ route('siswas.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Master Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jenis-pembayaran.index') ? 'active' : '' }}"
                    href="{{ route('jenis-pembayaran.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Master Jenis Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('verif.pembayaran.index') ? 'active' : '' }}"
                    href="{{ route('verif.pembayaran.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Verifikasi Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan.pembayaran.index') ? 'active' : '' }}"
                    href="{{ route('laporan.pembayaran.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun Saya </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin_profile') ? 'active' : '' }}"
                    href="{{ route('admin_profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link"
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                        <span class="nav-link-text ms-1">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>

    </div>
</aside>

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Pemilik Kendaraan</li>
        <li class="nav-item {{ request()->is('c/vehicle*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('vehicle.index') }}">
                <i class="mdi mdi-car-info menu-icon"></i>
                <span class="menu-title">Kendaraan Saya</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('booking.my*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('booking.my') }}">
                <i class="mdi mdi-tools menu-icon"></i>
                <span class="menu-title">Servis Saya</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/bukti-servis">
                <i class="mdi mdi-file-document-outline menu-icon"></i>
                <span class="menu-title">Bukti Servis</span>
            </a>
        </li>

        <li class="nav-item nav-category">Bengkel</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('service-orders.index') }}">
                <i class="mdi mdi-tools menu-icon"></i>
                <span class="menu-title">Servis Order</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-timer-sand menu-icon"></i>
                <span class="menu-title">Antrian Servis</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-car-wrench menu-icon"></i>
                <span class="menu-title">Servis Aktif</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-history menu-icon"></i>
                <span class="menu-title">Riwayat Servis</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-file-chart-outline menu-icon"></i>
                <span class="menu-title">Laporan Bengkel</span>
            </a>
        </li>
        <li
            class="nav-item {{ request()->routeIs('profile.mitra*') || request()->routeIs('edit.mitra') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.mitra') }}">
                <i class="mdi mdi-store-outline menu-icon"></i>
                <span class="menu-title">Profil Bengkel</span>
            </a>
        </li>

        <li class="nav-item nav-category">Admin</li>
        <li class="nav-item {{ request()->routeIs('manajemen-pengguna') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('manajemen-pengguna') }}">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">Manajemen Pengguna</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('mitra.manajemen') }}">
                <i class="mdi mdi-store-cog-outline menu-icon"></i>
                <span class="menu-title">Manajemen Bengkel</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-chart-line menu-icon"></i>
                <span class="menu-title">Analitik</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-cog-outline menu-icon"></i>
                <span class="menu-title">Pengaturan</span>
            </a>
        </li>
    </ul>
</nav>

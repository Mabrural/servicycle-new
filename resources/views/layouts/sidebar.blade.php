<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'customer')
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

            <li class="nav-item {{ request()->is('bukti-servis*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('bukti-servis') }}">
                    <i class="mdi mdi-file-document-outline menu-icon"></i>
                    <span class="menu-title">Bukti Servis</span>
                    <span class="badge bg-warning text-white ms-2">PRO</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 'mitra')
            <li class="nav-item nav-category">Bengkel</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('service-orders.index') }}">
                    <i class="mdi mdi-tools menu-icon"></i>
                    <span class="menu-title">Servis Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('scan.qr.customer') }}">
                    <i class="mdi mdi-qrcode-scan menu-icon"></i>
                    <span class="menu-title">Scan QR Customer</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.bengkel') }}">
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
        @endif

        @if (Auth::user()->role == 'admin')
            <li class="nav-item nav-category">Admin</li>

            <li
                class="nav-item {{ request()->routeIs('users.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                    <span class="menu-title">Manajemen Pengguna</span>
                </a>
            </li>
            <li
                class="nav-item {{ request()->routeIs('mitra.manajemen') || request()->routeIs('mitra.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mitra.manajemen') }}">
                    <i class="mdi mdi-store-cog-outline menu-icon"></i>
                    <span class="menu-title">Manajemen Bengkel</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.subscription.settings') }}">
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                    <span class="menu-title">Harga & Paket</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.coupons.index') }}">
                    <i class="mdi mdi-ticket-percent-outline menu-icon"></i>
                    <span class="menu-title">Kupon & Diskon</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.subscriptions.users.index') }}">
                    <i class="mdi mdi-account-star-outline menu-icon"></i>
                    <span class="menu-title">Langganan</span>
                </a>
            </li>
        @endif
    </ul>
</nav>

<!-- partial:partials/_sidebar.html -->
@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $setting = \App\Models\SubscriptionSetting::first();
    $proEnabled = $setting?->is_enabled ?? false;
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        {{-- ================= DASHBOARD ================= --}}
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- ================= CUSTOMER ================= --}}
        @if ($user->role === 'customer')
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
                <a class="nav-link d-flex align-items-center justify-content-between"
                    href="{{ route('bukti-servis') }}">

                    <span>
                        <i class="mdi mdi-file-document-outline menu-icon"></i>
                        <span class="menu-title">Bukti </span>
                    </span>

                    @if ($proEnabled)
                        <span class="badge bg-warning text-white">PRO</span>
                    @endif
                </a>
            </li>
        @endif

        {{-- ================= MITRA ================= --}}
        @if ($user->role === 'mitra')
            <li class="nav-item nav-category">Bengkel</li>

            <li class="nav-item {{ request()->routeIs('service-orders.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('service-orders.index') }}">
                    <i class="mdi mdi-tools menu-icon"></i>
                    <span class="menu-title">Servis Order</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('scan.qr.customer') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('scan.qr.customer') }}">
                    <i class="mdi mdi-qrcode-scan menu-icon"></i>
                    <span class="menu-title">Scan QR Customer</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('profile.mitra*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profile.mitra') }}">
                    <i class="mdi mdi-store-outline menu-icon"></i>
                    <span class="menu-title">Profil Bengkel</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('laporan/bengkel*') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center justify-content-between"
                    href="{{ route('laporan.bengkel') }}">

                    <span>
                        <i class="mdi mdi-file-chart-outline menu-icon"></i>
                        <span class="menu-title">Laporan</span>
                    </span>

                    @if ($proEnabled)
                        <span class="badge bg-warning text-white">PRO</span>
                    @endif
                </a>
            </li>
        @endif

        {{-- ================= ADMIN ================= --}}
        @if ($user->role === 'admin')
            <li class="nav-item nav-category">Admin</li>

            <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                    <span class="menu-title">Manajemen Pengguna</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('mitra.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mitra.manajemen') }}">
                    <i class="mdi mdi-store-cog-outline menu-icon"></i>
                    <span class="menu-title">Manajemen Bengkel</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.subscription.settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.subscription.settings') }}">
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                    <span class="menu-title">Harga & Paket</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.coupons.index') }}">
                    <i class="mdi mdi-ticket-percent-outline menu-icon"></i>
                    <span class="menu-title">Kupon & Diskon</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.subscriptions.users.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.subscriptions.users.index') }}">
                    <i class="mdi mdi-account-star-outline menu-icon"></i>
                    <span class="menu-title">Langganan</span>
                </a>
            </li>
        @endif

    </ul>
</nav>

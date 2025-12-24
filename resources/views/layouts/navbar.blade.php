<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">

    {{-- ================= BRAND ================= --}}
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>

        <a class="navbar-brand brand-logo" href="/dashboard">
            <img src="{{ asset('assets/images/logo-servicycle-purple.svg') }}" alt="Servicycle Logo">
        </a>

        <a class="navbar-brand brand-logo-mini" href="/dashboard">
            <img src="{{ asset('assets/images/icon-servicycle.svg') }}" alt="Servicycle Icon">
        </a>
    </div>

    {{-- ================= MENU ================= --}}
    <div class="navbar-menu-wrapper d-flex align-items-top">

        {{-- LEFT --}}
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block">
                <h4 class="welcome-sub-text mb-0">
                    Pantau Aktivitas Servis Anda
                </h4>
            </li>
        </ul>

        {{-- RIGHT --}}
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-dropdown">

                @php
                    use Carbon\Carbon;

                    $user = Auth::user();
                    $setting = \App\Models\SubscriptionSetting::first();
                    $isAdmin = $user->role === 'admin';
                    $proEnabled = $setting?->is_enabled ?? false;

                    $subscription = null;
                    $isPro = false;
                    $subscriptionLabel = null;

                    if (!$isAdmin && $proEnabled) {
                        $subscription = \App\Models\UserSubscription::where('user_id', $user->id)
                            ->where('is_pro', true)
                            ->where(function ($q) {
                                $q->where('is_lifetime', true)->orWhereDate('end_at', '>=', now());
                            })
                            ->first();

                        if ($subscription) {
                            $isPro = true;

                            if ($subscription->is_lifetime) {
                                $subscriptionLabel = 'Lifetime';
                            } elseif ($subscription->end_at) {
                                $subscriptionLabel =
                                    'Aktif sampai ' . Carbon::parse($subscription->end_at)->translatedFormat('d M Y');
                            }
                        }
                    }
                @endphp

                {{-- USER DROPDOWN TOGGLE --}}
                <a class="nav-link d-flex align-items-center gap-2" href="#" id="UserDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    {{-- PLAN BADGE --}}
                    @if (!$isAdmin && $proEnabled)
                        <span class="badge {{ $isPro ? 'bg-warning' : 'bg-secondary' }}">
                            {{ $isPro ? 'PRO' : 'FREE' }}
                        </span>
                    @endif

                    {{-- AVATAR --}}
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}"
                        alt="Profile image">
                </a>

                {{-- ================= DROPDOWN MENU ================= --}}
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown">

                    {{-- HEADER --}}
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}"
                            alt="Profile image">

                        <p class="mb-1 mt-3 fw-semibold">{{ $user->name }}</p>
                        <p class="fw-light text-muted mb-0">{{ $user->email }}</p>

                        {{-- ROLE / SUBSCRIPTION INFO --}}
                        @if ($isAdmin)
                            <span class="badge bg-dark mt-2">ADMIN</span>
                        @elseif ($isPro && $subscriptionLabel)
                            <div class="mt-2 text-warning small fw-semibold">
                                {{ $subscriptionLabel }}
                            </div>
                        @endif
                    </div>

                    {{-- UPGRADE --}}
                    @if (!$isAdmin && $proEnabled && !$isPro)
                        <a href="{{ route('subscription.plans') }}" class="dropdown-item text-warning fw-semibold">
                            <i class="mdi mdi-crown me-2"></i>
                            Upgrade ke PRO
                        </a>
                    @endif

                    {{-- PROFILE --}}
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="mdi mdi-account-outline me-2 text-primary"></i>
                        Profil Saya
                    </a>

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item border-0 bg-transparent"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mdi mdi-power me-2 text-primary"></i>
                            Keluar
                        </button>
                    </form>

                </div>
            </li>
        </ul>

        {{-- MOBILE TOGGLER --}}
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>

    </div>
</nav>

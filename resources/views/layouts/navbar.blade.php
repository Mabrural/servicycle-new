<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="/dashboard">
                <img src="{{ asset('assets/images/logo-servicycle-purple.svg') }}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="/dashboard">
                <img src="{{ asset('assets/images/icon-servicycle.svg') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                {{-- <h3 class="welcome-text">Selamat Datang, <span
                        class="text-black fw-bold">{{ Auth::user()->name ?? '' }}</span></h3> --}}
                <h4 class="welcome-sub-text">Pantau Aktivitas Servis Anda </h4>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-dropdown">
                <a class="nav-link d-flex align-items-center gap-2" id="UserDropdown" href="#"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    {{-- BADGE PLAN (HANYA USER NON-ADMIN) --}}
                    @if (Auth::user()->role !== 'admin')
                        @php
                            $subscription = \App\Models\UserSubscription::where('user_id', Auth::id())
                                ->where('is_pro', true)
                                ->where(function ($q) {
                                    $q->where('is_lifetime', true)->orWhereDate('end_at', '>=', now()->toDateString());
                                })
                                ->first();

                            $isPro = !is_null($subscription);
                        @endphp

                        <span class="badge {{ $isPro ? 'bg-success' : 'bg-secondary' }}">
                            {{ $isPro ? 'PRO' : 'FREE' }}
                        </span>
                    @endif


                    {{-- AVATAR --}}
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}"
                        alt="Profile image">
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

                    {{-- HEADER --}}
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}"
                            alt="Profile image">

                        <p class="mb-1 mt-3 fw-semibold">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="fw-light text-muted mb-0">
                            {{ Auth::user()->email }}
                        </p>

                        {{-- ROLE INFO (ADMIN) --}}
                        @if (Auth::user()->role === 'admin')
                            <span class="badge bg-dark mt-2">
                                ADMIN
                            </span>
                        @endif
                    </div>

                    {{-- UPGRADE MENU (HANYA USER FREE NON-ADMIN) --}}
                    @if (Auth::user()->role !== 'admin' && !Auth::user()->isPro())
                        <a href="{{ route('subscription.plans') }}" class="dropdown-item text-warning fw-semibold">
                            <i class="mdi mdi-crown me-2"></i>
                            Upgrade ke PRO
                        </a>
                    @endif


                    {{-- PROFIL --}}
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="mdi mdi-account-outline me-2 text-primary"></i>
                        Profil Saya
                    </a>

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
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


        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

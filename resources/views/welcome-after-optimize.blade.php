@extends('auth.layouts.main')

@section('container')
    {{-- Preload critical CSS --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </noscript>

    {{-- Inline critical CSS --}}
    <style>
        /* Critical CSS untuk above-the-fold content */
        :root {
            --sc-primary: #4f46e5;
            --sc-primary-dark: #4338ca;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 40%, #312e81 100%);
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15), transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1), transparent 40%);
        }
        .navbar-transparent {
            background-color: transparent !important;
        }
        .navbar-scrolled {
            background-color: var(--sc-primary) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>

    <div class="container-fluid px-0">

        {{-- ================= LOCATION NOTICE (Optimized) ================= --}}
        <div id="locationNotice" class="location-notice" style="display:none">
            <div class="container d-flex align-items-center justify-content-between gap-2 flex-wrap">
                <span class="location-text">
                    <i class="fas fa-map-marker-alt me-1"></i> Izinkan lokasi untuk menampilkan bengkel terdekat dari Anda
                </span>
                <button class="btn btn-primary btn-sm location-btn" onclick="requestLocation()">
                    Izinkan Lokasi
                </button>
            </div>
        </div>

        {{-- ================= NAVBAR (Optimized) ================= --}}
        <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-transparent">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                    <img src="{{ asset('assets/images/logo-variant.svg') }}" alt="ServiCycle Logo" height="32"
                        width="32" class="d-inline-block align-text-top" loading="eager">
                    <span>ServiCycle</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarServicycle"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarServicycle">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Bengkel
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/?vehicle=mobil">
                                        <i class="fas fa-car me-1"></i> Bengkel Mobil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/?vehicle=motor">
                                        <i class="fas fa-motorcycle me-1"></i> Bengkel Motor
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.mitra') }}">
                                Gabung Jadi Mitra
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-2">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-light text-white btn-sm">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-warning btn-sm">
                                Daftar
                            </a>
                        @endguest

                        @auth
                            <div class="dropdown">
                                <a class="btn btn-outline-light dropdown-toggle d-flex align-items-center text-white gap-2"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-chart-line me-1"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-1"></i> Keluar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{-- ================= HERO (Optimized) ================= --}}
        <section class="hero-section text-white position-relative overflow-hidden">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="badge bg-warning text-light mb-3 px-3 py-2">
                            Booking & Antrian Servis Digital
                        </span>
                        <h1 class="fw-bold display-5 mt-3 mb-3">
                            Booking Servis Kendaraan <br>
                            Jadi <span class="text-warning">Lebih Mudah</span>
                        </h1>
                        <p class="lead opacity-75 mb-4">
                            Booking online, datang ke bengkel, lalu <strong>scan QR untuk check-in</strong>.
                            Antrian dikelola otomatis oleh bengkel.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#searchForm" class="btn btn-warning btn-lg px-4">
                                <i class="fas fa-search me-1"></i> Cari Bengkel
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light text-white btn-lg px-4">
                                <i class="fas fa-user-plus me-1"></i> Daftar Gratis
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center mt-5 mt-lg-0">
                        <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid hero-image" alt="ServiCycle"
                            width="600" height="400" loading="eager" fetchpriority="high">
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= FILTER + TAB (Optimized) ================= --}}
        <section class="py-4 bg-light">
            <div class="container">
                <ul class="nav nav-pills justify-content-center mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $vehicle === 'mobil' ? 'active' : '' }}" href="?vehicle=mobil">
                            <i class="fas fa-car me-1"></i> Mobil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $vehicle === 'motor' ? 'active' : '' }}" href="?vehicle=motor">
                            <i class="fas fa-motorcycle me-1"></i> Motor
                        </a>
                    </li>
                </ul>

                <form method="GET" id="searchForm">
                    <input type="hidden" name="lat" id="lat" value="{{ $lat }}">
                    <input type="hidden" name="lng" id="lng" value="{{ $lng }}">
                    <input type="hidden" name="vehicle" value="{{ $vehicle }}">
                    <div class="row g-2">
                        <div class="col-md-9">
                            <input type="text" name="search" class="form-control form-control-lg"
                                placeholder="Cari bengkel atau lokasi..." value="{{ $search }}" autocomplete="off">
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                Cari Bengkel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        {{-- ================= MITRA LIST (Optimized) ================= --}}
        <section class="py-5">
            <div class="container">
                <h3 class="fw-bold mb-4 text-center">
                    Bengkel {{ ucfirst($vehicle) }} Terdekat
                </h3>

                @if ($mitras->count())
                    <div class="row g-4" id="mitraContainer">
                        @foreach ($mitras as $mitra)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('bengkel.show', $mitra->slug) }}"
                                    class="text-decoration-none text-dark">
                                    <div class="card h-100 shadow-sm border-0 mitra-card">
                                        <div class="mitra-image-wrapper">
                                            <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                data-src="{{ $mitra->coverImage ? asset('storage/' . $mitra->coverImage->image_path) : asset('assets/images/no-image.jpg') }}"
                                                alt="{{ $mitra->business_name }}" class="mitra-cover lazy-image"
                                                width="300" height="225" loading="lazy" decoding="async">
                                            
                                            <div class="position-absolute top-0 start-0 p-2">
                                                @if ($mitra->isOpenNow())
                                                    <span
                                                        class="badge bg-success-subtle text-success border rounded-pill px-3 py-2 small shadow-sm">
                                                        <i class="fa-solid fa-store me-1"></i> <b>Buka</b>
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-danger-subtle text-danger border rounded-pill px-3 py-2 small shadow-sm">
                                                        <i class="fa-solid fa-store-slash me-1"></i> <b>Tutup</b>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="fw-semibold mb-2 text-truncate">
                                                {{ $mitra->business_name }}
                                            </h6>
                                            <div class="text-muted small mb-2">
                                                <i class="fa-solid fa-location-dot me-1"></i>
                                                {{ $mitra->regency }}, {{ $mitra->province }}
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                @isset($mitra->distance)
                                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2 small">
                                                        <i class="fa-solid fa-location-crosshairs me-1 text-primary"></i>
                                                        {{ number_format($mitra->distance, 1) }} km
                                                    </span>
                                                @endisset

                                                @if ($mitra->antrian_count > 0)
                                                    <span
                                                        class="badge bg-warning-subtle text-warning border rounded-pill px-3 py-2 small">
                                                        <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                                        {{ $mitra->antrian_count }} antrian
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-success-subtle text-success border rounded-pill px-3 py-2 small">
                                                        <i class="fa-solid fa-circle-check me-1"></i>
                                                        Tanpa antrian
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted">
                        Belum ada bengkel {{ $vehicle }} terdaftar.
                    </div>
                @endif
            </div>
        </section>

    </div>

    {{-- ================= FITUR UNGGULAN ================= --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Unggulan ServiCycle</h2>
                <p class="text-muted mt-2">
                    ServiCycle membantu proses booking, check-in, dan antrian servis kendaraan
                    menjadi lebih tertata dan efisien.
                </p>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['icon' => 'fa-search', 'color' => 'bg-primary', 'title' => 'Cari Bengkel Terdekat', 'desc' => 'Temukan bengkel mobil atau motor terdekat berdasarkan lokasi dan jenis kendaraan yang Anda gunakan.'],
                    ['icon' => 'fa-calendar-check', 'color' => 'bg-success', 'title' => 'Booking Servis Online', 'desc' => 'Lakukan booking servis terlebih dahulu sebelum datang ke bengkel agar proses penerimaan kendaraan lebih teratur.'],
                    ['icon' => 'fa-qrcode', 'color' => 'bg-warning', 'title' => 'QR Check-in di Bengkel', 'desc' => 'Scan QR Code saat tiba di bengkel untuk melakukan check-in dan masuk ke dalam sistem antrian servis.'],
                    ['icon' => 'fa-sync-alt', 'color' => 'bg-info', 'title' => 'Antrian Servis Digital', 'desc' => 'Status antrian dikelola secara digital oleh bengkel sehingga proses servis menjadi lebih transparan dan terkontrol.'],
                    ['icon' => 'fa-history', 'color' => 'bg-secondary', 'title' => 'Riwayat Servis Kendaraan', 'desc' => 'Riwayat servis kendaraan tersimpan dan dapat dilihat kembali sebagai referensi perawatan berikutnya.'],
                    ['icon' => 'fa-car', 'color' => 'bg-dark', 'title' => 'Kelola Data Kendaraan', 'desc' => 'Simpan dan kelola data kendaraan Anda agar proses booking dan pencatatan servis menjadi lebih praktis.']
                ] as $feature)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <div class="feature-icon {{ $feature['color'] }} text-white mb-3">
                                <i class="fas {{ $feature['icon'] }}"></i>
                            </div>
                            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                            <p class="text-muted">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= GABUNG MITRA ================= --}}
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Gabung Menjadi Mitra ServiCycle</h2>
                    <p class="lead">Kelola booking, check-in, dan antrian servis bengkel Anda secara digital dan lebih teratur.</p>
                    <h5 class="fw-bold mt-4 mb-3">Keuntungan Menjadi Mitra</h5>
                    <ul class="list-unstyled mitra-benefit">
                        @foreach ([
                            'Booking servis online dari pelanggan',
                            'Sistem check-in menggunakan QR Code',
                            'Pengelolaan antrian servis secara digital',
                            'Data dan riwayat servis tersimpan rapi',
                            'Profil bengkel tampil di platform ServiCycle',
                            'Proses servis lebih tertata dan efisien'
                        ] as $benefit)
                            <li><i class="fas fa-check-circle text-white me-2"></i> {{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg p-4 text-center">
                        <h4 class="fw-bold mb-2">Daftarkan Bengkel Anda</h4>
                        <p class="text-muted mb-4">Mulai digitalisasi proses servis bengkel dan kelola pelanggan dengan sistem yang lebih modern.</p>
                        <a href="{{ route('register.mitra') }}" class="btn btn-warning btn-lg w-100">
                            <i class="fas fa-user-plus"></i> Daftar sebagai Mitra
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CARA KERJA ================= --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Cara Kerja ServiCycle</h2>
                <p class="text-muted mt-2">Proses servis kendaraan lebih tertata melalui 4 langkah sederhana</p>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['step' => '1', 'color' => 'bg-primary', 'title' => 'Daftar & Lengkapi Data', 'desc' => 'Buat akun dan lengkapi data kendaraan untuk mempermudah proses booking dan pencatatan servis.'],
                    ['step' => '2', 'color' => 'bg-success', 'title' => 'Booking Servis', 'desc' => 'Pilih bengkel dan ajukan booking servis sebelum datang ke lokasi bengkel.'],
                    ['step' => '3', 'color' => 'bg-warning', 'title' => 'Datang & Check-in QR', 'desc' => 'Scan QR Code di bengkel untuk melakukan check-in dan masuk ke antrian servis.'],
                    ['step' => '4', 'color' => 'bg-info', 'title' => 'Servis & Selesai', 'desc' => 'Kendaraan diservis oleh bengkel dan status servis diperbarui hingga proses dinyatakan selesai.']
                ] as $step)
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <div class="step-number {{ $step['color'] }} text-white mb-3">{{ $step['step'] }}</div>
                            <h5 class="fw-bold">{{ $step['title'] }}</h5>
                            <p class="text-muted">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="py-5 cta-section text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Siap Booking Servis Kendaraan Lebih Mudah?</h2>
            <p class="lead mb-4">Gunakan ServiCycle untuk booking servis, check-in bengkel, dan antrian kendaraan secara lebih tertata.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4">
                    <i class="fas fa-user-plus me-1"></i> Daftar & Mulai Booking
                </a>
                <a href="mailto:support@servicycle.com" class="btn btn-outline-light btn-lg px-4 text-white">
                    <i class="fas fa-phone me-1"></i> Hubungi Tim ServiCycle
                </a>
            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-dark text-light pt-5">
        <div class="container">
            <div class="row pb-4">
                <div class="col-lg-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('assets/images/logo-variant.svg') }}" alt="ServiCycle Logo" height="24" width="24" loading="lazy">
                        <h4 class="fw-bold mb-0">ServiCycle</h4>
                    </div>
                    <p>Platform digital untuk booking servis kendaraan, check-in bengkel, dan pengelolaan antrian secara lebih tertata.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">Navigasi</h5>
                    <ul class="list-unstyled footer-nav">
                        <li><a href="#" class="footer-link">Daftar Bengkel</a></li>
                        <li><a href="{{ route('register.mitra') }}" class="footer-link">Gabung Mitra Bengkel</a></li>
                        <li><a href="{{ route('privacy') }}" class="footer-link">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="footer-link">Syarat dan Ketentuan</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <p class="mb-1"><i class="fas fa-envelope me-2"></i> support@servicycle.id</p>
                    <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461</p>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center py-3">
                <small>© 2025 ServiCycle. All rights reserved.</small>
            </div>
        </div>
    </footer>

    {{-- ================= WHATSAPP FLOATING (Optimized) ================= --}}
    <a href="https://wa.me/6282178192938?text=Halo%20ServiCycle,%20saya%20ingin%20bertanya." class="whatsapp-float"
        target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp" onclick="hideWaBubble()">
        <span class="wa-bubble d-none" id="waBubble">Admin Online</span>
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp"
            class="whatsapp-icon" width="56" height="56" loading="lazy">
    </a>

    {{-- ================= DEFERRED STYLES ================= --}}
    <style>
        /* Mitra Card Styles */
        .mitra-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 14px;
            overflow: hidden;
        }
        .mitra-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }
        .mitra-image-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #f1f3f5;
        }
        .mitra-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }
        .lazy-image {
            filter: blur(8px);
            transform: scale(1.05);
        }
        .lazy-image.loaded {
            filter: blur(0);
            transform: scale(1);
        }
        
        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            right: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 9999;
            text-decoration: none;
        }
        .whatsapp-icon {
            background-color: #25d366;
            width: 56px;
            height: 56px;
            padding: 14px;
            border-radius: 50%;
            filter: invert(1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s;
        }
        .whatsapp-float:hover .whatsapp-icon {
            transform: scale(1.08);
        }
        .wa-bubble {
            position: relative;
            background: var(--sc-primary);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 18px;
            white-space: nowrap;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            animation: wa-float 2.5s infinite;
        }
        .wa-bubble::after {
            content: "";
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: var(--sc-primary);
        }
        @keyframes wa-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        @media (max-width: 576px) {
            .wa-bubble { display: none !important; }
        }

        /* Hero Animation */
        .hero-image {
            max-height: 420px;
            animation: floatHero 6s ease-in-out infinite;
        }
        @keyframes floatHero {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        /* Navbar */
        .navbar {
            transition: all 0.35s ease-in-out;
            padding: 18px 0;
        }
        .navbar-scrolled {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
        }

        /* Footer & Misc */
        .footer-link {
            color: #adb5bd;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 8px;
            transition: color 0.3s;
        }
        .footer-link:hover { color: #fff; }
        .cta-section { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        .mitra-benefit li {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* Location Notice */
        .location-notice {
            background: #e7f1ff;
            color: #0d6efd;
            padding: 12px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1055;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .location-text { font-size: 14px; font-weight: 500; }
        @media (max-width: 576px) {
            .location-notice .container {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            .location-text { font-size: 13px; }
            .location-btn { width: 100%; margin-top: 6px; }
        }

        /* Bootstrap Overrides */
        .bg-primary { background-color: var(--sc-primary) !important; }
        .btn-primary {
            background-color: var(--sc-primary);
            border-color: var(--sc-primary);
        }
        .btn-primary:hover {
            background-color: var(--sc-primary-dark);
            border-color: var(--sc-primary-dark);
        }
        .text-primary { color: var(--sc-primary) !important; }
        .nav-pills .nav-link.active { background-color: var(--sc-primary); }
    </style>

    {{-- ================= OPTIMIZED SCRIPTS ================= --}}
    <script>
        // Combine all scripts into one for better performance
        (function() {
            // DOM Elements
            const latInput = document.getElementById('lat');
            const lngInput = document.getElementById('lng');
            const noticeEl = document.getElementById('locationNotice');
            const navbarEl = document.getElementById('mainNavbar');
            const waBubble = document.getElementById('waBubble');

            // Geolocation
            window.requestLocation = function() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    latInput.value = position.coords.latitude;
                    lngInput.value = position.coords.longitude;
                    document.getElementById('searchForm').submit();
                });
            };

            // Location Notice
            function showLocationNotice() {
                noticeEl.style.display = 'block';
                navbarEl.style.top = noticeEl.offsetHeight + 'px';
            }

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 60) {
                    navbarEl.classList.add('navbar-scrolled');
                    navbarEl.classList.remove('navbar-transparent');
                } else {
                    navbarEl.classList.remove('navbar-scrolled');
                    navbarEl.classList.add('navbar-transparent');
                }
            });

            // WhatsApp bubble
            setTimeout(function() {
                waBubble.classList.remove('d-none');
            }, 3000);
            setTimeout(function() {
                waBubble.textContent = 'Butuh bantuan?';
            }, 6000);
            window.hideWaBubble = function() {
                waBubble.style.display = 'none';
            };

            // Lazy loading images
            document.addEventListener("DOMContentLoaded", function() {
                if (!latInput.value && navigator.geolocation) {
                    showLocationNotice();
                    setTimeout(function() {
                        window.requestLocation();
                    }, 1200);
                }

                // Intersection Observer for lazy images
                if ('IntersectionObserver' in window) {
                    const images = document.querySelectorAll(".lazy-image");
                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                img.src = img.dataset.src;
                                img.onload = function() {
                                    img.classList.add('loaded');
                                };
                                observer.unobserve(img);
                            }
                        });
                    }, { rootMargin: "100px" });
                    images.forEach(function(img) {
                        observer.observe(img);
                    });
                }
            });
        })();
    </script>
@endsection
@extends('auth.layouts.main')

@section('container')
    <div class="container-fluid px-0">

        {{-- ================= LOCATION NOTICE ================= --}}
        <div id="locationNotice" class="alert alert-info text-center rounded-0 d-none">
            📍 Izinkan lokasi untuk menampilkan bengkel terdekat dari Anda
            <button class="btn btn-sm btn-primary ms-2" onclick="requestLocation()">
                Izinkan Lokasi
            </button>
        </div>

        {{-- ================= NAVBAR ================= --}}
        <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-transparent">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                    <img src="{{ asset('assets/images/logo-variant.svg') }}" alt="ServiCycle Logo" height="32"
                        class="d-inline-block align-text-top">
                    <span>ServiCycle</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarServicycle">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarServicycle">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        {{-- DROPDOWN BENGKEL --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Bengkel
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/?vehicle=mobil">
                                        🚗 Bengkel Mobil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/?vehicle=motor">
                                        🏍️ Bengkel Motor
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- GABUNG MITRA --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.mitra') }}">
                                Gabung Jadi Mitra
                            </a>
                        </li>
                    </ul>

                    {{-- AUTH BUTTON --}}
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
                                    👤 {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            📊 Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger">
                                                🚪 Keluar
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


        {{-- ================= HERO ================= --}}
        <section class="hero-section text-white position-relative overflow-hidden">
            <div class="hero-overlay"></div>

            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="badge bg-warning text-light mb-3 px-3 py-2">
                            Platform Servis Kendaraan
                        </span>

                        <h1 class="fw-bold display-5 mt-3 mb-3">
                            Servis Kendaraan <br>
                            Jadi <span class="text-warning">Lebih Mudah</span>
                        </h1>

                        <p class="lead mb-4 opacity-75">
                            Temukan bengkel terpercaya terdekat dari lokasi Anda.
                            Tanpa ribet, tanpa antri panjang.
                        </p>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#searchForm" class="btn btn-warning btn-lg px-4">
                                🔍 Cari Bengkel
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light text-white btn-lg px-4">
                                Daftar Gratis
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 text-center mt-5 mt-lg-0">
                        <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid hero-image" alt="ServiCycle">
                    </div>
                </div>
            </div>
        </section>



        {{-- ================= FILTER + TAB ================= --}}
        <section class="py-4 bg-light">
            <div class="container">

                {{-- TABBAR --}}
                <ul class="nav nav-pills justify-content-center mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $vehicle === 'mobil' ? 'active' : '' }}" href="?vehicle=mobil">
                            🚗 Mobil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $vehicle === 'motor' ? 'active' : '' }}" href="?vehicle=motor">
                            🏍️ Motor
                        </a>
                    </li>
                </ul>

                {{-- SEARCH --}}
                <form method="GET" id="searchForm">
                    <input type="hidden" name="lat" id="lat" value="{{ $lat }}">
                    <input type="hidden" name="lng" id="lng" value="{{ $lng }}">
                    <input type="hidden" name="vehicle" value="{{ $vehicle }}">

                    <div class="row g-2">
                        <div class="col-md-9">
                            <input type="text" name="search" class="form-control form-control-lg"
                                placeholder="Cari bengkel atau lokasi..." value="{{ $search }}">
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg">
                                Cari Bengkel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        {{-- ================= MITRA LIST ================= --}}
        <section class="py-5">
            <div class="container">
                <h3 class="fw-bold mb-4 text-center">
                    Bengkel {{ ucfirst($vehicle) }} Terdekat
                </h3>

                @if ($mitras->count())
                    <div class="row g-4">
                        @foreach ($mitras as $mitra)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('bengkel.show', $mitra->slug) }}"
                                    class="text-decoration-none text-dark">

                                    <div class="card h-100 shadow-sm border-0 mitra-card">

                                        {{-- IMAGE (OPTIMIZED) --}}
                                        <div class="mitra-image-wrapper">
                                            <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                data-src="{{ $mitra->coverImage
                                                    ? asset('storage/' . $mitra->coverImage->image_path)
                                                    : asset('assets/images/no-image.jpg') }}"
                                                alt="{{ $mitra->business_name }}" class="mitra-cover lazy-image"
                                                loading="lazy" decoding="async">

                                            {{-- STATUS --}}
                                            <span
                                                class="badge status-badge {{ $mitra->isOpenNow() ? 'bg-success' : 'bg-danger' }}">
                                                {{ $mitra->isOpenNow() ? 'Buka Sekarang' : 'Tutup' }}
                                            </span>
                                        </div>

                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-truncate">
                                                {{ $mitra->business_name }}
                                            </h6>

                                            <small class="text-muted d-block">
                                                {{ $mitra->regency }}, {{ $mitra->province }}
                                            </small>

                                            @isset($mitra->distance)
                                                <div class="mt-2">
                                                    <span class="badge bg-light text-dark">
                                                        📍 {{ number_format($mitra->distance, 1) }} km dari Anda
                                                    </span>
                                                </div>
                                            @endisset

                                            <div class="mt-2">
                                                @if ($mitra->antrian_count > 0)
                                                    <span class="badge bg-warning text-white">
                                                        🔄 {{ $mitra->antrian_count }} kendaraan antri
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        ✅ Tidak ada antrian
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
                    Kami menyediakan segala yang Anda butuhkan untuk booking dan mengelola
                    servis kendaraan dengan mudah
                </p>
            </div>

            <div class="row g-4">

                {{-- Cari Bengkel Terdekat --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-primary text-white mb-3">
                            📍
                        </div>
                        <h5 class="fw-bold">Cari Bengkel Terdekat</h5>
                        <p class="text-muted">
                            Temukan bengkel terpercaya di sekitar lokasi Anda — semua bengkel
                            di platform kami telah melalui proses verifikasi secara menyeluruh.
                        </p>
                    </div>
                </div>

                {{-- Booking Online --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-success text-white mb-3">
                            📅
                        </div>
                        <h5 class="fw-bold">Booking Online 24/7</h5>
                        <p class="text-muted">
                            Pesan servis kapan saja dengan pilihan tanggal dan waktu yang
                            fleksibel sesuai kebutuhan Anda.
                        </p>
                    </div>
                </div>

                {{-- Riwayat Servis --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-warning text-white mb-3">
                            📋
                        </div>
                        <h5 class="fw-bold">Riwayat Servis Digital</h5>
                        <p class="text-muted">
                            Seluruh riwayat servis tercatat dan tersimpan rapi dalam satu platform.
                        </p>
                    </div>
                </div>

                {{-- Notifikasi --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-info text-white mb-3">
                            🔔
                        </div>
                        <h5 class="fw-bold">Notifikasi Status Servis</h5>
                        <p class="text-muted">
                            Dapatkan notifikasi email setiap kali ada perubahan status booking,
                            mulai dari pengajuan, persetujuan, hingga penolakan.
                        </p>
                    </div>
                </div>

                {{-- Kelola Kendaraan --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-secondary text-white mb-3">
                            🚗
                        </div>
                        <h5 class="fw-bold">Kelola Kendaraan</h5>
                        <p class="text-muted">
                            Simpan dan atur data kendaraan Anda dalam satu tempat, sehingga
                            lebih mudah dikelola saat melakukan booking servis.
                        </p>
                    </div>
                </div>

                {{-- Transaksi Aman --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="feature-icon bg-dark text-white mb-3">
                            🔒
                        </div>
                        <h5 class="fw-bold">Transaksi Aman</h5>
                        <p class="text-muted">
                            Sistem pembayaran yang aman dengan berbagai metode pembayaran
                            yang tersedia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= GABUNG MITRA ================= --}}
    <section class="py-5 bg-primary text-white">
        <div class="container">

            <div class="row align-items-center">

                {{-- LEFT CONTENT --}}
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">
                        Gabung Menjadi Mitra
                    </h2>
                    <p class="lead">
                        Tingkatkan bisnis bengkel Anda dengan bergabung sebagai mitra ServiCycle
                    </p>

                    <h5 class="fw-bold mt-4 mb-3">
                        Keuntungan Menjadi Mitra
                    </h5>

                    <ul class="list-unstyled mitra-benefit">
                        <li>✅ Jangkauan pelanggan yang lebih luas</li>
                        <li>✅ Booking servis otomatis 24/7</li>
                        <li>✅ Profil bengkel terverifikasi</li>
                        <li>✅ Riwayat servis pelanggan yang terorganisir</li>
                        <li>✅ Notifikasi booking langsung</li>
                        <li>✅ Meningkatkan kredibilitas bengkel</li>
                    </ul>
                </div>

                {{-- RIGHT CONTENT --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg p-4 text-center">
                        <h4 class="fw-bold mb-2">
                            Daftar Sekarang
                        </h4>
                        <p class="text-muted mb-4">
                            Bergabunglah dengan jaringan bengkel terpercaya dan dapatkan
                            lebih banyak pelanggan
                        </p>

                        <a href="{{ route('register.mitra') }}" class="btn btn-warning btn-lg w-100">
                            🚀 Daftar sebagai Mitra
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
                <p class="text-muted mt-2">
                    Hanya perlu 3 langkah mudah untuk booking servis kendaraan Anda
                </p>
            </div>

            <div class="row g-4">

                {{-- STEP 1 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="step-number bg-primary text-white mb-3">
                            1
                        </div>
                        <h5 class="fw-bold">Daftar & Input Kendaraan</h5>
                        <p class="text-muted">
                            Buat akun gratis dan tambahkan data kendaraan Anda ke dalam sistem
                        </p>
                    </div>
                </div>

                {{-- STEP 2 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="step-number bg-success text-white mb-3">
                            2
                        </div>
                        <h5 class="fw-bold">Pilih Bengkel</h5>
                        <p class="text-muted">
                            Temukan bengkel terdekat dan pilih layanan servis yang dibutuhkan
                        </p>
                    </div>
                </div>

                {{-- STEP 3 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="step-number bg-warning text-white mb-3">
                            3
                        </div>
                        <h5 class="fw-bold">Booking Servis</h5>
                        <p class="text-muted">
                            Pilih tanggal dan waktu, lalu konfirmasi booking servis Anda
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="py-5 cta-section text-white">
        <div class="container text-center">

            <h2 class="fw-bold mb-3">
                Siap Mengelola Servis Kendaraan Anda?
            </h2>

            <p class="lead mb-4">
                Bergabunglah dengan ribuan pengguna lainnya dan rasakan kemudahan
                mengelola perawatan kendaraan
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4">
                    🚀 Daftar Sekarang – Gratis
                </a>
                <a href="mailto:support@servicycle.com" class="btn btn-outline-light btn-lg px-4 text-white">
                    📞 Hubungi Kami
                </a>
            </div>

        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-dark text-light pt-5">
        <div class="container">

            <div class="row pb-4">

                {{-- BRAND --}}
                <div class="col-lg-4 mb-4">
                    <h4 class="fw-bold">ServiCycle</h4>
                    <p class="">
                        Platform terdepan untuk manajemen perawatan kendaraan Anda.
                    </p>
                </div>

                {{-- NAVIGATION --}}
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">Navigasi</h5>
                    <ul class="list-unstyled footer-nav">
                        <li>
                            <a href="#" class="footer-link">Bengkel</a>
                        </li>
                        <li>
                            <a href="{{ route('register.mitra') }}" class="footer-link">Gabung Mitra</a>
                        </li>
                        <li>
                            <a href="mailto:support@servicycle.id" class="footer-link">Kontak</a>
                        </li>
                    </ul>
                </div>

                {{-- CONTACT --}}
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <p class="mb-1">
                        📧 support@servicycle.id
                    </p>
                    <p class="mb-0">
                        📍 Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam,
                        Kepulauan Riau 29461
                    </p>
                </div>

            </div>

            <hr class="border-secondary">

            <div class="text-center py-3">
                <small class="">
                    © 2025 ServiCycle. All rights reserved.
                </small>
            </div>

        </div>
    </footer>
    <!-- ================= WHATSAPP FLOATING ================= -->
    <a href="https://wa.me/6282178192938?text=Halo%20ServiCycle,%20saya%20ingin%20bertanya." class="whatsapp-float"
        target="_blank" aria-label="Chat WhatsApp" onclick="hideWaBubble()">

        <span class="wa-bubble d-none" id="waBubble">
            Admin Online
        </span>

        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp"
            class="whatsapp-icon">
    </a>


    {{-- ================= STYLE ================= --}}
    <style>
        /* ================= MITRA CARD ================= */
        .mitra-card {
            transition: 0.3s ease;
            border-radius: 14px;
            overflow: hidden;
        }

        .mitra-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .mitra-cover {
            height: 180px;
            object-fit: cover;
        }

        /* STATUS BADGE */
        .status-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        /* CLOSE STATE (OPTIONAL DIM) */
        .mitra-card .bg-danger {
            background-color: #dc3545 !important;
        }

        .hover-card {
            transition: 0.3s;
        }

        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, .15);
        }

        /* ================= WHATSAPP FLOATING ================= */
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

        /* icon */
        .whatsapp-icon {
            background-color: #25d366;
            width: 56px;
            height: 56px;
            padding: 14px;
            border-radius: 50%;
            filter: invert(1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            transition: 0.3s;
        }

        .whatsapp-float:hover .whatsapp-icon {
            transform: scale(1.08);
        }

        /* bubble */
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

        /* arrow */
        .wa-bubble::after {
            content: "";
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: var(--sc-primary);
        }

        /* animasi lembut */
        @keyframes wa-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        /* sembunyikan bubble di mobile */
        @media (max-width: 576px) {
            .wa-bubble {
                display: none !important;
            }
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg,
                    #4f46e5 0%,
                    #4338ca 40%,
                    #312e81 100%);
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15), transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1), transparent 40%);
        }

        .hero-image {
            max-height: 420px;
            animation: floatHero 6s ease-in-out infinite;
        }

        /* animasi halus */
        @keyframes floatHero {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* ================= NAVBAR ANIMATION ================= */
        .navbar {
            transition: all 0.35s ease-in-out;
            padding: 18px 0;
        }

        /* kondisi awal */
        .navbar-transparent {
            background-color: transparent !important;
        }

        /* kondisi setelah scroll */
        .navbar-scrolled {
            background-color: var(--sc-primary) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
        }


        .footer-link {
            color: #adb5bd;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: #fff;
        }

        .cta-section {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
        }

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

        .mitra-cover {
            height: 180px;
            object-fit: cover;
            cursor: pointer;
        }

        .nav-pills .nav-link {
            font-weight: 600;
        }
    </style>
    <style>
        /* wrapper agar layout tidak loncat */
        .mitra-image-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #f1f3f5;
        }

        /* image */
        .mitra-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        /* skeleton effect */
        .lazy-image {
            filter: blur(8px);
            transform: scale(1.05);
        }

        .lazy-image.loaded {
            filter: blur(0);
            transform: scale(1);
        }
    </style>

    <style>
        :root {
            --sc-primary: #4f46e5;
            --sc-primary-dark: #4338ca;
        }

        /* override bootstrap primary */
        .bg-primary {
            background-color: var(--sc-primary) !important;
        }

        .btn-primary {
            background-color: var(--sc-primary);
            border-color: var(--sc-primary);
        }

        .btn-primary:hover {
            background-color: var(--sc-primary-dark);
            border-color: var(--sc-primary-dark);
        }

        .text-primary {
            color: var(--sc-primary) !important;
        }

        .nav-pills .nav-link.active {
            background-color: var(--sc-primary);
        }
    </style>


    {{-- ================= GEOLOCATION SCRIPT ================= --}}
    <script>
        const latInput = document.getElementById('lat');
        const lngInput = document.getElementById('lng');
        const notice = document.getElementById('locationNotice');

        function requestLocation() {
            navigator.geolocation.getCurrentPosition(position => {
                latInput.value = position.coords.latitude;
                lngInput.value = position.coords.longitude;
                document.getElementById('searchForm').submit();
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!latInput.value && navigator.geolocation) {
                notice.classList.remove('d-none');

                // auto request after short delay (UX friendly)
                setTimeout(() => {
                    requestLocation();
                }, 1200);
            }
        });
    </script>

    <script>
        const navbar = document.getElementById('mainNavbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-transparent');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('navbar-transparent');
            }
        });
    </script>

    <script>
        const waBubble = document.getElementById('waBubble');

        // tampilkan bubble setelah 3 detik
        setTimeout(() => {
            waBubble.classList.remove('d-none');
        }, 3000);

        // ganti teks setelah 6 detik
        setTimeout(() => {
            waBubble.textContent = 'Butuh bantuan?';
        }, 6000);

        // sembunyikan bubble setelah klik
        function hideWaBubble() {
            waBubble.style.display = 'none';
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const images = document.querySelectorAll(".lazy-image");

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.onload = () => img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: "100px"
            });

            images.forEach(img => observer.observe(img));
        });
    </script>


@endsection

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
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light text-white">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-warning">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        {{-- ================= HERO ================= --}}
        <section class="bg-primary text-white py-5 hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="fw-bold mt-5 mb-3">
                            Servis Kendaraan Jadi Lebih Mudah
                        </h1>
                        <p class="lead mb-4">
                            Temukan bengkel terpercaya terdekat dari lokasi Anda.
                            Tanpa ribet, tanpa antri panjang.
                        </p>

                        <a href="#searchForm" class="btn btn-warning btn-lg">
                            🔍 Cari Bengkel Terdekat
                        </a>
                    </div>

                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid" alt="ServiCycle">
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
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 shadow-sm border-0">

                                    <img src="{{ $mitra->coverImage
                                        ? asset('storage/' . $mitra->coverImage->image_path)
                                        : asset('assets/images/no-image.jpg') }}"
                                        class="card-img-top mitra-cover" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $mitra->id }}">

                                    <div class="card-body">
                                        <h5 class="fw-bold mb-1">
                                            {{ $mitra->business_name }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $mitra->regency }}, {{ $mitra->province }}
                                        </small>

                                        @isset($mitra->distance)
                                            <div class="mt-2">
                                                <span class="badge bg-info">
                                                    📍 {{ number_format($mitra->distance, 1) }} km dari Anda
                                                </span>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL IMAGE --}}
                            <div class="modal fade" id="modal{{ $mitra->id }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <img src="{{ $mitra->coverImage
                                            ? asset('storage/' . $mitra->coverImage->image_path)
                                            : asset('assets/images/no-image.jpg') }}"
                                            class="img-fluid w-100">
                                    </div>
                                </div>
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

    {{-- ================= STYLE ================= --}}
    <style>
        .hero-section {
            padding-top: 120px;
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
            height: 220px;
            object-fit: cover;
            cursor: pointer;
        }

        .nav-pills .nav-link {
            font-weight: 600;
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

@endsection

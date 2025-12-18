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

        {{-- ================= HERO ================= --}}
        <section class="bg-primary text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="fw-bold mb-3">
                            Servis Kendaraan Jadi Lebih Mudah 🚀
                        </h1>
                        <p class="lead mb-4">
                            Temukan bengkel terpercaya terdekat dari lokasi Anda.
                            Tanpa ribet, tanpa antri panjang.
                        </p>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                Daftar Akun
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                                Masuk
                            </a>
                            <a href="{{ route('register.mitra') }}" class="btn btn-warning btn-lg">
                                Gabung Jadi Mitra
                            </a>
                        </div>
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

    {{-- ================= STYLE ================= --}}
    <style>
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
@endsection

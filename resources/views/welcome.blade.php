@extends('auth.layouts.main')

@section('container')
    <div class="container-fluid px-0">

        {{-- ================= HERO SECTION ================= --}}
        <section class="bg-primary text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="fw-bold mb-3">
                            Servis Kendaraan Jadi Lebih Mudah 🚀
                        </h1>
                        <p class="lead mb-4">
                            Temukan bengkel terpercaya terdekat dari lokasi Anda.
                            Booking online, datang tanpa ribet.
                        </p>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg fw-semibold">
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

        {{-- ================= SEARCH SECTION ================= --}}
        <section class="py-4 bg-light">
            <div class="container">
                <form method="GET" id="searchForm">
                    <input type="hidden" name="lat" id="lat" value="{{ $lat }}">
                    <input type="hidden" name="lng" id="lng" value="{{ $lng }}">

                    <div class="row g-2">
                        <div class="col-md-9">
                            <input type="text" name="search" class="form-control form-control-lg"
                                placeholder="Cari bengkel atau lokasi..." value="{{ $search }}">
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg">
                                Cari Bengkel Terdekat
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
                    Bengkel Mitra Terdekat
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
                                                    📍 {{ number_format($mitra->distance, 1) }} km dari lokasi Anda
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
                        Belum ada bengkel mitra terdaftar.
                    </div>
                @endif
            </div>
        </section>

    </div>

    {{-- ================= STYLE ================= --}}
    <style>
        .mitra-cover {
            height: 220px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>

    {{-- ================= GEOLOCATION SCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!navigator.geolocation) return;

            if (!document.getElementById('lat').value) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lng').value = position.coords.longitude;
                });
            }
        });
    </script>
@endsection

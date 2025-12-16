@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper px-0">

                {{-- ================= HERO LOGIN ================= --}}
                <div class="d-flex align-items-center auth">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-center py-5 px-4 px-sm-5">

                                @include('auth.layouts.brand-logo')

                                <h3 class="fw-bold mb-2">Selamat Datang di ServiCycle</h3>
                                <p class="fw-light mb-4">
                                    Kelola servis kendaraan Anda dengan mudah, cepat, dan terorganisir.
                                </p>

                                <div class="mt-3 d-grid gap-2">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg fw-medium">
                                        MASUK
                                    </a>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg fw-medium">
                                        DAFTAR AKUN
                                    </a>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <a href="{{ route('register.mitra') }}"
                                        class="btn btn-outline-primary btn-lg fw-medium">
                                        GABUNG JADI MITRA
                                    </a>
                                </div>

                                <div class="text-center mt-4 fw-light text-muted">
                                    Bengkel & pemilik kendaraan ✅
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= DAFTAR BENGKEL ================= --}}
                <div class="container mt-5">
                    <h4 class="fw-bold mb-4 text-center">
                        Bengkel Mitra Terdaftar
                    </h4>

                    @if ($mitras->count())
                        <div class="row g-4">
                            @foreach ($mitras as $mitra)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card h-100 shadow-sm border-0">

                                        {{-- Cover Image --}}
                                        <div class="position-relative">
                                            <img src="{{ $mitra->coverImage
                                                ? asset('storage/' . $mitra->coverImage->image_path)
                                                : asset('assets/images/no-image.jpg') }}"
                                                class="card-img-top mitra-cover" data-bs-toggle="modal"
                                                data-bs-target="#coverModal{{ $mitra->id }}"
                                                alt="{{ $mitra->business_name }}">

                                            {{-- Badge Open / Closed --}}
                                            <span
                                                class="badge {{ $mitra->isOpenNow() ? 'bg-success' : 'bg-secondary' }} position-absolute top-0 end-0 m-2">
                                                {{ $mitra->isOpenNow() ? 'BUKA' : 'TUTUP' }}
                                            </span>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="fw-bold mb-1">
                                                {{ $mitra->business_name }}
                                            </h5>

                                            <small class="text-muted">
                                                {{ $mitra->regency }}, {{ $mitra->province }}
                                            </small>

                                            <p class="mt-2 text-muted small">
                                                {{ Str::limit($mitra->description, 90) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= MODAL PREVIEW ================= --}}
                                <div class="modal fade" id="coverModal{{ $mitra->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-body p-0">
                                                <img src="{{ $mitra->coverImage
                                                    ? asset('storage/' . $mitra->coverImage->image_path)
                                                    : asset('assets/images/no-image.jpg') }}"
                                                    class="img-fluid w-100" alt="{{ $mitra->business_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted">
                            Belum ada bengkel mitra yang aktif.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- ================= STYLE ================= --}}
    <style>
        .mitra-cover {
            height: 220px;
            object-fit: cover;
            cursor: pointer;
            transition: transform .3s ease;
        }

        .mitra-cover:hover {
            transform: scale(1.03);
        }
    </style>
@endsection

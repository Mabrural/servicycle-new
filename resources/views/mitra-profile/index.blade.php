@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href=""
                                        role="tab" aria-controls="overview" aria-selected="true">Profil Bengkel</a>
                                </li>
                            </ul>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Data Profil Belum Lengkap.</strong>
                            Untuk dapat diproses lebih lanjut, mohon lengkapi seluruh informasi profil bengkel Anda.
                            <a href="{{ route('edit.mitra') }}">Lengkapi profil sekarang</a>.
                        </div>

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">

                                {{-- Alert --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                {{-- Jika tidak ada mitra --}}
                                @if ($mitras->count() == 0)
                                    <div class="alert alert-info mt-4">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Belum ada mitra terdaftar.
                                    </div>
                                @endif

                                <div class="row mt-4">

                                    @foreach ($mitras as $mitra)
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <div class="card shadow-sm border-0 h-100 rounded-4">

                                                <!-- Full Width Image -->
                                                <img src="{{ asset('assets/images/bengkel-image.jpg') }}" alt="Foto Mitra"
                                                    class="img-fluid w-100 rounded-top"
                                                    style="height: 180px; object-fit: cover;">

                                                <div class="card-body d-flex flex-column">

                                                    <!-- Business Name -->
                                                    <h5 class="fw-bold text-dark">{{ $mitra->business_name }}</h5>
                                                    <div class="d-flex justify-content-start mb-2">
                                                        <a href="{{ route('edit.mitra') }}"
                                                            class="btn btn-outline-primary btn-sm rounded-pill">
                                                            <i class="mdi mdi-pencil"></i> Edit Profil
                                                        </a>
                                                    </div>


                                                    <!-- Status -->
                                                    <div class="col-lg-4">
                                                        @if ($mitra->is_active)
                                                            <span class="badge rounded-pill mb-3"
                                                                style="background-color:#0d6efd; padding:6px 12px; display:inline-flex; align-items:center; gap:6px; width:auto;">
                                                                <i class="mdi mdi-check-decagram"></i>
                                                                Terverifikasi
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill bg-secondary mb-3"
                                                                style="padding:6px 12px; display:inline-flex; align-items:center; gap:6px; width:auto;">
                                                                <i class="mdi mdi-timer-sand"></i>
                                                                Masih ditinjau
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <!-- Vehicle Types -->
                                                    <p class="text-muted fw-semibold small mb-1">Tipe Kendaraan:</p>

                                                    @php
                                                        $vehicles = is_array($mitra->vehicle_type)
                                                            ? $mitra->vehicle_type
                                                            : [$mitra->vehicle_type];
                                                    @endphp

                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($vehicles as $vehicle)
                                                            <span class="badge bg-info text-white py-2 px-3"
                                                                style="display:inline-flex; align-items:center; width:auto;">
                                                                {{ ucwords($vehicle) }}
                                                            </span>
                                                        @endforeach
                                                    </div>


                                                    <hr>

                                                    <!-- Location -->
                                                    <p class="mb-1 text-dark">
                                                        <i class="mdi mdi-map-marker-outline me-1"></i>
                                                        {{ $mitra->province }} — {{ $mitra->regency }}
                                                    </p>

                                                    <!-- Address -->
                                                    <p class="text-muted small">
                                                        <i class="mdi mdi-home-map-marker me-1"></i>
                                                        {{ Str::limit($mitra->address, 80) }}
                                                    </p>

                                                    <a href="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                                        target="_blank">
                                                        Buka Lokasi di Google Maps
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div> {{-- end overview --}}
                        </div>

                    </div>
                </div>
            </div>

        </div>

        @include('layouts.footer')
    </div>

    @push('scripts')
        <script>
            // Script untuk toggle tab
            $(document).ready(function() {
                $('.nav-tabs a').on('click', function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        </script>
    @endpush
@endsection

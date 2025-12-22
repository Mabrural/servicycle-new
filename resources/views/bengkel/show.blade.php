@extends('auth.layouts.main')

@section('container')
    <section class="bg-light py-4">
        <div class="container">

            {{-- ================= BACK ================= --}}
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary text-dark mb-3">
                <- Kembali
            </a>

            {{-- ================= HEADER ================= --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <img src="{{ $mitra->coverImage
                            ? asset('storage/' . $mitra->coverImage->image_path)
                            : asset('assets/images/no-image.jpg') }}"
                            class="img-fluid h-100 w-100 rounded-start" style="object-fit: cover;">
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-1">{{ $mitra->business_name }}</h3>

                            <p class="text-muted mb-2">
                                📍 {{ $mitra->address }},
                                {{ $mitra->regency }},
                                {{ $mitra->province }}
                            </p>

                            {{-- STATUS OPEN --}}
                            @if ($mitra->isOpenNow())
                                <span class="badge bg-success mb-2"> Buka Sekarang</span>
                            @else
                                <span class="badge bg-danger mb-2"> Tutup</span>
                            @endif

                            @isset($mitra->distance)
                                <span class="badge bg-info ms-2">
                                    {{ number_format($mitra->distance, 1) }} km dari Anda
                                </span>
                            @endisset

                            <hr>

                            <p class="text-muted">
                                {{ $mitra->description ?? 'Belum ada deskripsi bengkel.' }}
                            </p>

                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-primary">
                                    📅 Booking Servis
                                </a>
                                <a href="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                    target="_blank" class="btn btn-outline-secondary text-dark">
                                    🗺️ Buka di Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= CONTENT ================= --}}
            <div class="row g-4">

                {{-- ===== LEFT ===== --}}
                <div class="col-lg-8">

                    {{-- SERVICES --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">🔧 Layanan Servis</h5>
                            <div class="row">
                                @forelse ($mitra->services ?? [] as $service)
                                    <div class="col-md-6 mb-2">✔ {{ $service }}</div>
                                @empty
                                    <p class="text-muted">Belum ada layanan servis.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    {{-- GALLERY --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">🖼️ Galeri Bengkel</h5>
                            <div class="row g-3">
                                @forelse ($mitra->images as $image)
                                    <div class="col-6 col-md-4">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                            class="img-fluid rounded shadow-sm" style="height: 140px; object-fit: cover;">
                                    </div>
                                @empty
                                    <p class="text-muted">Belum ada galeri.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- MAP --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">📍 Lokasi Bengkel</h5>
                            <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                                src="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}&output=embed">
                            </iframe>
                        </div>
                    </div>

                </div>

                {{-- ===== RIGHT ===== --}}
                <div class="col-lg-4">

                    {{-- OPERATIONAL HOURS --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">⏰ Jam Operasional</h6>
                            @foreach ($mitra->operational_hours as $day => $info)
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-capitalize">{{ $day }}</span>
                                    @if (!empty($info['open']))
                                        <span class="text-muted">
                                            {{ $info['start'] }} - {{ $info['end'] }}
                                        </span>
                                    @else
                                        <span class="text-danger">Tutup</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- PAYMENT METHOD --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">💳 Metode Pembayaran</h6>
                            @foreach ($mitra->payment_method ?? [] as $method)
                                <span class="badge bg-light text-dark border me-1 mb-1">
                                    {{ $method }}
                                </span>
                            @endforeach

                            @if (empty($mitra->payment_method))
                                <p class="text-muted mb-0">Belum ada metode pembayaran.</p>
                            @endif

                        </div>
                    </div>

                    {{-- FACILITIES --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">🏪 Fasilitas</h6>
                            @foreach ($mitra->facilities ?? [] as $facility)
                                <div class="mb-1">✔ {{ $facility }}</div>
                            @endforeach

                            @if (empty($mitra->facilities))
                                <p class="text-muted mb-0">Belum ada fasilitas.</p>
                            @endif

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection

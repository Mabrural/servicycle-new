@extends('auth.layouts.main')

@section('container')
    <section class="py-5 bg-light">
        <div class="container">

            {{-- BACK --}}
            <a href="/" class="btn btn-sm btn-outline-secondary mb-4">
                ← Kembali
            </a>

            <div class="row g-4">

                {{-- IMAGE --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ $mitra->coverImage
                            ? asset('storage/' . $mitra->coverImage->image_path)
                            : asset('assets/images/no-image.jpg') }}"
                            class="img-fluid rounded">
                    </div>
                </div>

                {{-- DETAIL --}}
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-2">
                        {{ $mitra->business_name }}
                    </h2>

                    <p class="text-muted mb-2">
                        📍 {{ $mitra->address }},
                        {{ $mitra->regency }},
                        {{ $mitra->province }}
                    </p>

                    @isset($mitra->distance)
                        <span class="badge bg-info mb-3">
                            {{ number_format($mitra->distance, 1) }} km dari Anda
                        </span>
                    @endisset

                    <hr>

                    <h5 class="fw-bold">Tentang Bengkel</h5>
                    <p class="text-muted">
                        {{ $mitra->description ?? 'Belum ada deskripsi bengkel.' }}
                    </p>

                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn btn-primary btn-lg">
                            📅 Booking Servis
                        </a>
                        <a href="https://wa.me/62xxxxxxxxxx" target="_blank" class="btn btn-outline-success btn-lg">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

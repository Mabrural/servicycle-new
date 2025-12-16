@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- HEADER --}}
            <div class="row mb-4 align-items-center">
                <div class="col-md-8">
                    <h4 class="fw-bold mb-1">{{ $mitra->business_name }}</h4>
                    <p class="text-muted mb-0">Detail Profil Bengkel Mitra</p>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    @if ($mitra->is_active)
                        <span class="badge bg-success px-3 py-2">Aktif</span>
                    @else
                        <span class="badge bg-danger px-3 py-2">Nonaktif</span>
                    @endif
                </div>
            </div>

            {{-- ALERT PROFILE INCOMPLETE --}}
            @if ($mitra->isProfileIncomplete())
                <div class="alert alert-warning d-flex align-items-center mb-4">
                    <i class="mdi mdi-alert-circle-outline fs-4 me-2"></i>
                    <div>
                        Profil bengkel belum lengkap. Lengkapi data untuk meningkatkan kepercayaan pelanggan.
                    </div>
                </div>
            @endif

            <div class="row">

                {{-- LEFT CONTENT --}}
                <div class="col-lg-8">

                    {{-- COVER IMAGE --}}
                    <div class="card card-rounded mb-4 overflow-hidden">
                        <div class="card-body p-0">
                            @if ($mitra->coverImage)
                                <div class="cover-image-wrapper" data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                    data-img="{{ asset('storage/' . $mitra->coverImage->image_path) }}">
                                    <img src="{{ asset('storage/' . $mitra->coverImage->image_path) }}" alt="Cover Bengkel">
                                </div>
                            @else
                                <div class="p-5 text-center text-muted">
                                    <i class="mdi mdi-image-off-outline fs-1"></i>
                                    <p class="mt-2 mb-0">Belum ada cover image</p>
                                </div>
                            @endif
                        </div>
                    </div>


                    {{-- INFORMASI UMUM --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Informasi Bengkel</h5>

                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="35%">Alamat</td>
                                    <td>: {{ $mitra->address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>: {{ $mitra->province ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kab/Kota</td>
                                    <td>: {{ $mitra->regency ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinat</td>
                                    <td>
                                        :
                                        @if ($mitra->latitude && $mitra->longitude)
                                            {{ $mitra->latitude }}, {{ $mitra->longitude }}
                                            <br>
                                            <a href="https://maps.google.com/?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                                target="_blank" class="small">
                                                Lihat di Google Maps
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Deskripsi Bengkel</h5>
                            <p class="text-muted mb-0">
                                {{ $mitra->description ?? 'Belum ada deskripsi bengkel.' }}
                            </p>
                        </div>
                    </div>

                    {{-- LAYANAN --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Layanan Tersedia</h5>
                            @if (!empty($mitra->services))
                                @foreach ($mitra->services as $service)
                                    <span
                                        class="badge bg-info text-dark me-1 mb-1">{{ ucfirst(str_replace('_', ' ', $service)) }}</span>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Tidak ada data layanan</p>
                            @endif
                        </div>
                    </div>

                    {{-- FASILITAS --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Fasilitas</h5>
                            @if (!empty($mitra->facilities))
                                <ul class="list-unstyled mb-0">
                                    @foreach ($mitra->facilities as $facility)
                                        <li class="mb-1">
                                            <i class="mdi mdi-check-circle text-success me-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $facility)) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0">Tidak ada fasilitas terdaftar</p>
                            @endif
                        </div>
                    </div>

                    {{-- GALERI --}}
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Galeri Bengkel</h5>

                            @if ($mitra->images->count())
                                <div class="row g-3">
                                    @foreach ($mitra->images as $img)
                                        <div class="col-6 col-md-4">
                                            <img src="{{ asset('storage/' . $img->image_path) }}" class="gallery-thumb"
                                                alt="Galeri Bengkel" data-bs-toggle="modal"
                                                data-bs-target="#imagePreviewModal"
                                                data-img="{{ asset('storage/' . $img->image_path) }}">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">Belum ada foto bengkel</p>
                            @endif
                        </div>
                    </div>


                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="col-lg-4 mt-4 mt-lg-0">

                    {{-- JAM OPERASIONAL --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Jam Operasional</h5>

                            @php
                                $days = [
                                    'monday' => 'Senin',
                                    'tuesday' => 'Selasa',
                                    'wednesday' => 'Rabu',
                                    'thursday' => 'Kamis',
                                    'friday' => 'Jumat',
                                    'saturday' => 'Sabtu',
                                    'sunday' => 'Minggu',
                                ];
                            @endphp

                            <ul class="list-group list-group-flush">
                                @foreach ($days as $key => $label)
                                    @php $day = $mitra->operational_hours[$key] ?? null; @endphp
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ $label }}</span>
                                        <span class="text-muted">
                                            {{ $day && $day['open'] ? $day['start'] . ' - ' . $day['end'] : 'Tutup' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <hr>

                            <span class="badge {{ $mitra->isOpenNow() ? 'bg-success' : 'bg-danger' }} w-100 py-2">
                                {{ $mitra->isOpenNow() ? 'Sedang Buka' : 'Sedang Tutup' }}
                            </span>
                        </div>
                    </div>

                    {{-- INFO TAMBAHAN --}}
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Informasi Tambahan</h5>

                            <p class="mb-2">
                                <strong>Jenis Kendaraan:</strong><br>
                                @foreach ($mitra->vehicle_type ?? [] as $v)
                                    <span class="badge bg-secondary me-1">{{ ucfirst($v) }}</span>
                                @endforeach
                            </p>

                            <p class="mb-2">
                                <strong>Metode Pembayaran:</strong><br>
                                @foreach ($mitra->payment_method ?? [] as $pay)
                                    <span class="badge bg-light text-dark me-1">{{ ucfirst($pay) }}</span>
                                @endforeach
                            </p>

                            <p class="mb-0">
                                <strong>Dibuat oleh:</strong><br>
                                {{ $mitra->creator->name ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <a href="{{ route('mitra.manajemen') }}" class="btn btn-light px-4 rounded-pill">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>

        </div>

        {{-- MODAL IMAGE PREVIEW --}}
        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-md-down">
                <div class="modal-content bg-transparent border-0 shadow-none">
                    <div class="modal-body p-0 d-flex justify-content-center">

                        <div class="modal-image-wrapper position-relative">

                            {{-- CLOSE BUTTON --}}
                            <button type="button" class="btn-close btn-close-white image-modal-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>

                            {{-- IMAGE --}}
                            <img src="" id="modalPreviewImage" class="modal-img">

                        </div>

                    </div>
                </div>
            </div>
        </div>



        @include('layouts.footer')
    </div>
@endsection

@push('styles')
    <style>
        /* === GALLERY === */
        .gallery-thumb {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .gallery-thumb:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
        }

        /* === COVER IMAGE === */
        .cover-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            cursor: zoom-in;
        }

        .cover-image-wrapper img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform .3s ease;
        }

        .cover-image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* === MODAL IMAGE WRAPPER === */
        .modal-image-wrapper {
            position: relative;
            max-width: 100%;
            max-height: 90vh;
        }

        /* IMAGE */
        .modal-img {
            width: auto;
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 14px;
            background: #000;
        }

        /* CLOSE BUTTON */
        .image-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.65);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            opacity: 1;
            padding: 0;
        }

        /* Hover feedback */
        .image-modal-close:hover {
            background-color: rgba(0, 0, 0, 0.85);
        }

        /* MOBILE ADJUST */
        @media (max-width: 768px) {
            .image-modal-close {
                top: 10px;
                right: 10px;
                width: 32px;
                height: 32px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = document.getElementById('imagePreviewModal');
            const modalImg = document.getElementById('modalPreviewImage');

            modal.addEventListener('show.bs.modal', function(event) {
                const trigger = event.relatedTarget;
                const imgSrc = trigger.getAttribute('data-img');
                modalImg.src = imgSrc;
            });

            modal.addEventListener('hidden.bs.modal', function() {
                modalImg.src = '';
            });

        });
    </script>
@endpush

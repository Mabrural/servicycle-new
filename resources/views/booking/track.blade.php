@extends('auth.layouts.main')

@section('container')
    <div class="container py-4">

        <h4 class="fw-bold mb-4">📍 Detail & Lacak Servis</h4>
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('booking.my') }}" class="btn btn-sm btn-outline-secondary text-dark">
                <i class="mdi mdi-arrow-left me-1"></i> Kembali
            </a>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-body">

                @php
                    $statusColor = match ($order->status) {
                        'pending' => 'secondary',
                        'accepted' => 'info',
                        'checked_in' => 'primary',
                        'waiting' => 'warning',
                        'in_progress' => 'primary',
                        'done' => 'success',
                        'picked_up' => 'secondary',
                        'rejected', 'cancelled', 'no_show' => 'danger',
                        default => 'light',
                    };

                    $statusText = match ($order->status) {
                        // BOOKING
                        'pending' => 'Booking berhasil dibuat. Menunggu konfirmasi dari bengkel.',
                        'accepted' => 'Booking diterima bengkel. Silakan datang ke bengkel sesuai jadwal.',
                        'rejected' => 'Booking ditolak oleh bengkel. Silakan cari bengkel lain.',
                        'cancelled' => 'Booking dibatalkan.',
                        'no_show' => 'Anda tidak datang ke bengkel sesuai jadwal.',
                        // ANTRIAN & SERVIS
                        'checked_in' => 'Anda sudah check-in di bengkel. Menunggu masuk antrian.',
                        'waiting' => 'Kendaraan Anda sedang menunggu giliran servis.',
                        'in_progress' => 'Kendaraan Anda sedang dalam proses servis.',
                        'done' => 'Servis telah selesai. Silakan ambil kendaraan Anda.',
                        'picked_up' => 'Kendaraan sudah diambil. Terima kasih telah menggunakan layanan kami.',

                        default => 'Status tidak diketahui.',
                    };
                @endphp


                <div class="text-center mb-4">
                    <span class="badge bg-{{ $statusColor }} px-4 py-2 fs-6">
                        {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                    </span>

                    <p class="text-muted mt-2 mb-0 small">
                        {{ $statusText }}
                    </p>
                </div>

                <hr>

                {{-- ================= BENGKEL ================= --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">
                        <i class="mdi mdi-store me-1"></i> Bengkel
                    </h6>

                    <div class="ps-3">
                        <div class="fw-semibold">{{ $order->mitra->business_name }}</div>
                        <small class="text-muted">
                            📍 {{ $order->mitra->regency }},
                            {{ $order->mitra->province }}
                        </small>
                    </div>
                </div>

                {{-- ================= KENDARAAN ================= --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">
                        <i class="mdi mdi-car me-1"></i> Kendaraan
                    </h6>

                    <div class="ps-3">
                        <div class="fw-semibold">
                            {{ $order->vehicle_brand_manual }}
                            {{ $order->vehicle_model_manual }}
                        </div>

                        <small class="text-muted">
                            Plat Nomor: {{ $order->vehicle_plate_manual }}
                        </small>
                    </div>
                </div>

                {{-- ================= KELUHAN ================= --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">
                        <i class="mdi mdi-comment-text-outline me-1"></i> Keluhan Kendaraan
                    </h6>

                    <div class="alert alert-light mb-0">
                        {{ $order->customer_complain ?? '-' }}
                    </div>
                </div>

                {{-- ================= INFO BOOKING ================= --}}
                <div class="mb-2">
                    <h6 class="fw-bold mb-2">
                        <i class="mdi mdi-information-outline me-1"></i> Informasi Booking
                    </h6>

                    <ul class="list-unstyled small ps-3 mb-0">
                        <li class="mb-1">
                            <strong>Tanggal Booking:</strong>
                            {{ $order->created_at->format('d M Y') }}
                        </li>
                        <li class="mb-1">
                            <strong>Waktu Booking:</strong>
                            {{ $order->created_at->format('H:i') }} WIB
                        </li>
                        <li>
                            <strong>ID Booking:</strong>
                            <span class="text-muted">{{ $order->uuid }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
@endsection

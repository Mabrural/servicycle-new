@extends('auth.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <div class="container py-5" style="max-width: 720px">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-4">
            <div class="mb-3">
                <span class="badge bg-success px-4 py-2 fs-6 rounded-pill">
                   <i class="fas fa-check-circle me-1"></i> Booking Berhasil
                </span>
            </div>

            <h4 class="fw-bold mb-1">
                {{ $order->mitra->business_name }}
            </h4>

            <p class="text-muted mb-0">
                {{ $order->mitra->regency }}, {{ $order->mitra->province }}
            </p>
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body text-center">

                <div class="mb-3">
                    <i class="fas fa-clock text-warning fs-1"></i>
                </div>

                <h5 class="fw-bold mb-2">
                    Menunggu Konfirmasi Bengkel
                </h5>

                <p class="text-muted small mb-0">
                    Booking kamu sudah tercatat.
                    Bengkel akan mengonfirmasi ketersediaan servis.
                </p>

            </div>
        </div>

        {{-- ================= NEXT STEP ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <h6 class="fw-bold mb-3">
                    <i class="fas fa-arrow-right text-primary me-1"></i> Langkah Selanjutnya
                </h6>

                <ul class="small text-muted mb-0 ps-3">
                    <li>Bengkel mengecek antrean & kesiapan servis</li>
                    <li>Status booking akan diperbarui setelah disetujui</li>
                    <li>QR Check-in muncul setelah booking diterima</li>
                </ul>

            </div>
        </div>

        {{-- ================= BOOKING DETAIL ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <h6 class="fw-bold mb-3">
                    <i class="fas fa-file-alt text-primary me-1"></i> Detail Booking
                </h6>

                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted">Kendaraan</td>
                        <td class="text-end fw-semibold">
                            {{ $order->vehicle_brand_manual ?? '-' }}
                            {{ $order->vehicle_model_manual ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Plat Nomor</td>
                        <td class="text-end fw-semibold">
                            {{ $order->vehicle_plate_manual ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Keluhan</td>
                        <td class="text-end fw-semibold">
                            {{ $order->customer_complain ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Kode Booking</td>
                        <td class="text-end fw-bold text-primary">
                            #{{ strtoupper(substr($order->uuid, -8)) }}
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('welcome') }}" class="btn btn-default text-dark px-4">
                <i class="fas fa-arrow-left me-1"></i> Ke Beranda
            </a>
            <a href="{{ route('booking.my') }}" class="btn btn-outline-secondary text-dark px-4">
              <i class="fas fa-eye me-1"></i>  Lihat Servis Saya
            </a>
        </div>

    </div>
@endsection

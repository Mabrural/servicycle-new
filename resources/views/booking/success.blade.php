@extends('auth.layouts.main')

@section('container')
    <div class="container py-5" style="max-width: 720px">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-4">
            <div class="mb-3">
                <span class="badge bg-success px-4 py-2 fs-6 rounded-pill">
                    Booking Berhasil
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
                    <i class="mdi mdi-clock-outline text-warning fs-1"></i>
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
                    📌 Langkah Selanjutnya
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
                    📋 Detail Booking
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
        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary text-dark px-4">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
@endsection

@extends('auth.layouts.main')

@section('container')
    <div class="container py-5 text-center">

        <div class="card shadow-sm border-0 mx-auto" style="max-width: 420px">
            <div class="card-body">

                <h4 class="fw-bold text-success mb-2">
                    ✅ Booking Berhasil
                </h4>

                <p class="text-muted mb-4">
                    Booking servis Anda telah tercatat
                </p>

                {{-- INFO BENGKEL --}}
                <div class="mb-3">
                    <h6 class="fw-bold mb-0">{{ $order->mitra->business_name }}</h6>
                    <small class="text-muted">
                        📍 {{ $order->mitra->regency }}, {{ $order->mitra->province }}
                    </small>
                </div>

                {{-- STATUS --}}
                <span class="badge bg-warning mb-3">
                    Menunggu Konfirmasi Bengkel
                </span>

                {{-- QR --}}
                <div class="my-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(url('/check-in/' . $order->id . '?token=' . $order->checkin_token)) }}"
                        alt="QR Booking">
                </div>


                <p class="small text-muted">
                    📲 Tunjukkan QR ini ke bengkel saat tiba untuk check-in
                </p>

                {{-- BOOKING CODE --}}
                <div class="alert alert-light border mt-3">
                    <small class="text-muted">Kode Booking</small>
                    <div class="fw-bold">
                        SC-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100 mt-3">
                    Kembali ke Dashboard
                </a>

            </div>
        </div>

    </div>
@endsection

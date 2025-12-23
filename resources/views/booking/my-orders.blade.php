@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">🛠️ Servis Saya</h4>
            </div>

            @forelse ($orders as $order)
                <a href="{{ route('booking.track', $order->uuid) }}" class="text-decoration-none text-dark">

                    <div class="card shadow-sm border-0 mb-3 service-card">
                        <div class="card-body">

                            {{-- HEADER --}}
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $order->mitra->business_name }}
                                    </h6>
                                    <small class="text-muted">
                                        📍 {{ $order->mitra->regency }}, {{ $order->mitra->province }}
                                    </small>
                                </div>

                                {{-- STATUS --}}
                                @php
                                    $statusColor = match ($order->status) {
                                        'waiting' => 'warning',
                                        'accepted' => 'info',
                                        'in_progress' => 'primary',
                                        'done' => 'success',
                                        default => 'secondary',
                                    };

                                    $statusLabel = strtoupper(str_replace('_', ' ', $order->status));
                                @endphp

                                <span class="badge bg-{{ $statusColor }} px-3 py-2">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <hr class="my-2">

                            {{-- BODY --}}
                            <div class="row small text-muted">
                                <div class="col-md-6 mb-1">
                                    🚗 <strong>Kendaraan:</strong>
                                    {{ $order->vehicle_brand_manual }}
                                    {{ $order->vehicle_model_manual }}
                                </div>

                                <div class="col-md-6 mb-1 text-md-end">
                                    🔢 <strong>Plat:</strong>
                                    {{ $order->vehicle_plate_manual }}
                                </div>

                                <div class="col-md-6">
                                    🗓️ <strong>Tanggal:</strong>
                                    {{ $order->created_at->format('d M Y') }}
                                </div>

                                <div class="col-md-6 text-md-end">
                                    🧾 <strong>Kode Servis:</strong>
                                    #{{ strtoupper(substr($order->uuid, -8)) }}
                                </div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="mt-3 d-flex justify-content-end">
                                <span class="text-primary fw-semibold small">
                                    Lihat Detail →
                                </span>
                            </div>

                        </div>
                    </div>
                </a>

            @empty
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted py-5">
                        <i class="mdi mdi-car-wrench fs-2 mb-2 d-block"></i>
                        Belum ada riwayat servis
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    {{-- OPTIONAL STYLE --}}
    @push('styles')
        <style>
            .service-card {
                transition: all .2s ease;
            }

            .service-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            }
        </style>
    @endpush
@endsection

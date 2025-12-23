@forelse ($orders as $order)
    @php
        $statusColor = match ($order->status) {
            'waiting' => 'warning',
            'accepted' => 'info',
            'in_progress' => 'primary',
            'done' => 'success',
            'cancelled', 'rejected', 'no_show' => 'secondary',
            default => 'dark',
        };

        $statusLabel = strtoupper(str_replace('_', ' ', $order->status));
    @endphp

    <a href="{{ route('booking.track', $order->uuid) }}" class="text-decoration-none text-dark">

        <div class="card service-card border-0 shadow-sm mb-3">
            <div class="card-body p-3">

                {{-- STATUS --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-{{ $statusColor }}">
                        {{ $statusLabel }}
                    </span>

                    <small class="text-muted">
                        {{ $order->created_at->format('d M Y') }}
                    </small>
                </div>

                {{-- MITRA --}}
                <h6 class="fw-bold mb-1">
                    {{ $order->mitra->business_name }}
                </h6>

                <small class="text-muted d-block mb-2">
                    📍 {{ $order->mitra->regency }},
                    {{ $order->mitra->province }}
                </small>

                {{-- KENDARAAN --}}
                <div class="fw-semibold">
                    🚗 {{ $order->vehicle_brand_manual }}
                    {{ $order->vehicle_model_manual }}
                </div>

                <small class="text-muted">
                    Plat: {{ $order->vehicle_plate_manual }}
                </small>

                {{-- CTA --}}
                <div class="mt-3">
                    <span class="text-primary fw-semibold small">
                        Lihat Detail →
                    </span>
                </div>
                @if ($order->status === 'accepted')
                    <div class="mt-3 p-3 border rounded bg-light text-center">

                        <p class="mb-2 fw-semibold text-info">
                            Tunjukkan QR ini ke bengkel saat datang
                        </p>

                        {!! QrCode::size(160)->style('round')->generate(route('check-in.show', $order->qr_token)) !!}

                        <small class="text-muted d-block mt-2">
                            QR hanya bisa di-scan oleh bengkel terkait
                        </small>
                    </div>
                @endif


            </div>
        </div>

    </a>

@empty
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center text-muted py-5">
            <i class="mdi mdi-car-wrench fs-2 d-block mb-2"></i>
            {{ $emptyText }}
        </div>
    </div>
@endforelse

@push('styles')
    <style>
        .service-card {
            cursor: pointer;
        }

        .service-card a {
            display: block;
        }

        .nav-link,
        .service-card {
            min-height: 44px;
            /* Apple touch guideline */
        }
    </style>
@endpush

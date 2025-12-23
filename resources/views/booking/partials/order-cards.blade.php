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

    <div class="card service-card border-0 shadow-sm mb-3">

        {{-- CLICKABLE AREA --}}
        <a href="{{ route('booking.track', $order->uuid) }}" class="text-decoration-none text-dark">

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

            </div>
        </a>

        {{-- QR SECTION --}}
        @if ($order->status === 'accepted')
            <div class="border-top bg-light p-3 text-center qr-section">

                <div class="fw-semibold mb-2">
                    <i class="mdi mdi-qrcode-scan me-1"></i>
                    QR Check-in Bengkel
                </div>

                <div class="d-flex justify-content-center my-2">
                    {!! QrCode::size(160)->style('round')->generate(route('check-in.show', $order->qr_token)) !!}
                </div>

                <small class="text-muted">
                    Tunjukkan QR ini ke bengkel saat kedatangan
                </small>

            </div>
        @endif

    </div>

@empty
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center text-muted py-5">
            <i class="mdi mdi-car-wrench fs-2 d-block mb-2"></i>
            {{ $emptyText }}
        </div>
    </div>
@endforelse

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
        {{-- ACTION FOOTER --}}
        @if ($order->status === 'pending')
            <div class="card-footer bg-white border-top text-end">
                <form action="{{ route('booking.cancel', $order->uuid) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan servis ini?')">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger text-danger">
                        <i class="mdi mdi-close-circle-outline me-1"></i>
                        Batalkan Servis
                    </button>
                </form>
            </div>
        @endif

        {{-- QR SECTION --}}
        @if ($order->status === 'accepted')
            <div class="border-top bg-light p-3 text-center qr-section">

                <div class="fw-semibold mb-2">
                    <i class="mdi mdi-qrcode-scan me-1"></i>
                    QR Check-in Bengkel
                </div>

                {{-- QR --}}
                <div class="d-flex justify-content-center my-2">
                    <div id="qr-{{ $order->id }}">
                        {!! QrCode::size(160)->style('round')->generate(route('check-in.show', $order->qr_token)) !!}
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <button class="btn btn-outline-primary btn-sm text-dark"
                        onclick="downloadQR('{{ $order->id }}', '{{ $order->uuid }}')">
                        <i class="mdi mdi-download me-1 text-dark"></i>
                        Download QR
                    </button>
                </div>

                <small class="text-muted d-block mt-2">
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

@push('scripts')
    <script>
        function downloadQR(orderId, uuid) {
            const qrWrapper = document.getElementById('qr-' + orderId);
            const svg = qrWrapper.querySelector('svg');

            if (!svg) {
                alert('QR tidak ditemukan');
                return;
            }

            // Serialize SVG
            const serializer = new XMLSerializer();
            const svgStr = serializer.serializeToString(svg);

            // Create canvas
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            const img = new Image();
            const svgBlob = new Blob([svgStr], {
                type: 'image/svg+xml;charset=utf-8'
            });
            const url = URL.createObjectURL(svgBlob);

            img.onload = function() {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                URL.revokeObjectURL(url);

                // Convert to PNG
                const pngUrl = canvas.toDataURL('image/png');

                // Trigger download
                const a = document.createElement('a');
                a.href = pngUrl;
                a.download = 'QR-Checkin-' + uuid.substring(0, 8) + '.png';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            };

            img.src = url;
        }
    </script>
@endpush

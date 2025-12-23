@extends('auth.layouts.main')

@section('container')
    <div class="container py-4">

        <h4 class="fw-bold mb-3">📍 Lacak Servis</h4>

        <div class="card shadow-sm border-0">
            <div class="card-body text-center">

                <h5 class="fw-bold">{{ $order->mitra->business_name }}</h5>
                <p class="text-muted mb-2">
                    {{ $order->vehicle_brand_manual }}
                    {{ $order->vehicle_model_manual }}
                    • {{ $order->vehicle_plate_manual }}
                </p>

                {{-- STATUS --}}
                @php
                    $statusColor = match ($order->status) {
                        'waiting' => 'warning',
                        'accepted' => 'info',
                        'in_progress' => 'primary',
                        'done' => 'success',
                        'picked_up' => 'secondary',
                        default => 'light',
                    };
                @endphp

                <span class="badge px-3 py-2 bg-{{ $statusColor }}">
                    {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                </span>

                {{-- QR CODE --}}
                @if (in_array($order->status, ['accepted', 'in_progress']))
                    <div class="my-4">
                        <div class="alert alert-info small">
                            📲 Tunjukkan QR ini ke bengkel saat datang
                        </div>

                        <img src="{{ route('booking.qr', ['uuid' => $order->uuid]) }}" alt="QR Code"
                            class="img-fluid border rounded p-2" style="max-width:220px">
                    </div>
                @else
                    <div class="alert alert-warning mt-4 small">
                        ⏳ Menunggu konfirmasi bengkel
                        <br>
                        QR akan muncul setelah booking diterima
                    </div>
                @endif




            </div>
        </div>

    </div>
@endsection

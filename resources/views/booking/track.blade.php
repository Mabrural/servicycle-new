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
            <span class="badge px-3 py-2 bg-{{ 
                $order->status === 'pending' ? 'warning' :
                ($order->status === 'accepted' ? 'info' :
                ($order->status === 'checked_in' ? 'primary' :
                ($order->status === 'in_progress' ? 'secondary' : 'success')))
            }}">
                {{ strtoupper(str_replace('_', ' ', $order->status)) }}
            </span>

            {{-- QR CODE (HANYA JIKA ACCEPTED KE ATAS) --}}
            @if (in_array($order->status, ['accepted', 'checked_in', 'in_progress']))
                <div class="my-4">
                    <div class="alert alert-info">
                        📲 Tunjukkan QR ini ke bengkel saat datang
                    </div>

                    <img src="{{ route('booking.qr', $order->id) }}" alt="QR Code">
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    ⏳ Menunggu konfirmasi bengkel  
                    <br>
                    QR akan muncul setelah booking diterima
                </div>
            @endif

        </div>
    </div>

</div>
@endsection

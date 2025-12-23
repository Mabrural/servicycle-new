@extends('layouts.main')

@section('container')
<div class="container py-4">

    <h4 class="fw-bold mb-3">🛠️ Servis Saya</h4>

    @forelse ($orders as $order)
        <a href="{{ route('booking.track', $order->id) }}"
           class="text-decoration-none text-dark">

            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="fw-bold mb-1">
                            {{ $order->mitra->business_name }}
                        </h6>
                        <small class="text-muted">
                            {{ $order->vehicle_brand_manual }}
                            {{ $order->vehicle_model_manual }}
                            • {{ $order->vehicle_plate_manual }}
                        </small>
                    </div>

                    <span class="badge bg-{{ 
                        $order->status === 'pending' ? 'warning' :
                        ($order->status === 'accepted' ? 'info' :
                        ($order->status === 'checked_in' ? 'primary' :
                        ($order->status === 'in_progress' ? 'secondary' : 'success')))
                    }}">
                        {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                    </span>

                </div>
            </div>
        </a>
    @empty
        <div class="alert alert-light text-center">
            Belum ada booking servis
        </div>
    @endforelse

</div>
@endsection

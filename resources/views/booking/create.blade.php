@extends('auth.layouts.main')

@section('container')
<div class="container py-5">

    <h4 class="fw-bold mb-3">📅 Booking Servis</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- INFO BENGKEL --}}
            <div class="mb-4">
                <h5 class="fw-bold mb-1">{{ $mitra->business_name }}</h5>
                <small class="text-muted">
                    {{ $mitra->regency }}, {{ $mitra->province }}
                </small>
            </div>

            <form method="POST" action="{{ route('booking.store', $mitra->slug) }}">
                @csrf

                {{-- KELUHAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Keluhan Kendaraan
                    </label>
                    <textarea name="customer_complain"
                              class="form-control"
                              rows="3"
                              required
                              placeholder="Mesin berisik, rem kurang pakem, dll"></textarea>
                </div>

                {{-- OPTIONAL: MANUAL VEHICLE --}}
                <hr>
                <h6 class="fw-bold">Data Kendaraan (Opsional)</h6>

                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="vehicle_brand_manual"
                               class="form-control"
                               placeholder="Merek Kendaraan">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="vehicle_model_manual"
                               class="form-control"
                               placeholder="Model Kendaraan">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="vehicle_type_manual"
                               class="form-control"
                               placeholder="Mobil / Motor">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="vehicle_plate_manual"
                               class="form-control"
                               placeholder="Nomor Polisi">
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-4">
                    🚀 Kirim Booking
                </button>

            </form>

        </div>
    </div>

</div>
@endsection

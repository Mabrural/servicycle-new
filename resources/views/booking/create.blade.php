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

                    {{-- PILIH KENDARAAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Pilih Kendaraan
                        </label>

                        <select name="vehicle_id" id="vehicleSelect" class="form-select">
                            <option value="">-- Pilih kendaraan terdaftar --</option>

                            @forelse ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">
                                    {{ strtoupper($vehicle->type) }} -
                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                    ({{ $vehicle->plate_number }})
                                </option>
                            @empty
                                <option disabled>
                                    Belum ada kendaraan terdaftar
                                </option>
                            @endforelse
                        </select>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            <small class="text-muted">
                                Jika kendaraan tidak ada, tambahkan dulu kendaraan baru
                            </small>

                            <a href="{{ route('vehicle.index') }}" class="btn btn-sm btn-outline-primary">
                                ➕ Tambah Kendaraan
                            </a>
                        </div>
                    </div>


                    {{-- DATA KENDARAAN --}}
                    <hr>
                    <h6 class="fw-bold">Data Kendaraan</h6>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" id="vehicle_brand" name="vehicle_brand_manual" class="form-control"
                                placeholder="Merek Kendaraan" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="vehicle_model" name="vehicle_model_manual" class="form-control"
                                placeholder="Model Kendaraan" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="vehicle_type" name="vehicle_type_manual" class="form-control"
                                placeholder="Mobil / Motor" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="vehicle_plate" name="vehicle_plate_manual" class="form-control"
                                placeholder="Nomor Polisi" readonly>
                        </div>
                    </div>

                    <hr>

                    {{-- KELUHAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Keluhan Kendaraan
                        </label>
                        <textarea name="customer_complain" class="form-control" rows="3" required
                            placeholder="Mesin berisik, rem kurang pakem, dll"></textarea>
                    </div>

                    <button class="btn btn-primary w-100 mt-4">
                        🚀 Kirim Booking
                    </button>
                </form>

            </div>
        </div>

    </div>

    {{-- ================= AJAX SCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('vehicleSelect');

            const brand = document.getElementById('vehicle_brand');
            const model = document.getElementById('vehicle_model');
            const type = document.getElementById('vehicle_type');
            const plate = document.getElementById('vehicle_plate');

            select.addEventListener('change', function() {
                const vehicleId = this.value;

                // reset
                [brand, model, type, plate].forEach(el => {
                    el.value = '';
                    el.readOnly = false;
                });

                if (!vehicleId) return;

                fetch(`/ajax/vehicle/${vehicleId}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Network error');
                        return res.json();
                    })
                    .then(data => {
                        brand.value = data.brand;
                        model.value = data.model;
                        type.value = data.type;
                        plate.value = data.plate;

                        [brand, model, type, plate].forEach(el => {
                            el.readOnly = true;
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Gagal mengambil data kendaraan');
                    });
            });
        });
    </script>
@endsection

@extends('layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card card-rounded">
                    <div class="card-body">

                        <h4 class="card-title card-title-dash">
                            Input Servis Walk-In
                        </h4>
                        <p class="card-subtitle card-subtitle-dash">
                            Digunakan untuk customer yang datang langsung ke bengkel
                        </p>

                        <form action="{{ route('service-orders.walk_in.store') }}" method="POST">
                            @csrf

                            <hr>
                            <h5>Data Customer</h5>

                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" name="customer_name"
                                    class="form-control"
                                    value="{{ old('customer_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="customer_phone"
                                    class="form-control"
                                    value="{{ old('customer_phone') }}" required>
                            </div>

                            <hr>
                            <h5>Data Kendaraan</h5>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <select name="vehicle_type_manual" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="motor">Motor</option>
                                    <option value="mobil">Mobil</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Merek</label>
                                <input type="text" name="vehicle_brand_manual"
                                    class="form-control"
                                    value="{{ old('vehicle_brand_manual') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Model</label>
                                <input type="text" name="vehicle_model_manual"
                                    class="form-control"
                                    value="{{ old('vehicle_model_manual') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Plat Nomor</label>
                                <input type="text" name="vehicle_plate_manual"
                                    class="form-control"
                                    value="{{ old('vehicle_plate_manual') }}" required>
                            </div>

                            <hr>
                            <h5>Keluhan</h5>

                            <div class="mb-3">
                                <textarea name="customer_complain" rows="4"
                                    class="form-control"
                                    placeholder="Keluhan customer...">{{ old('customer_complain') }}</textarea>
                            </div>

                            <div class="text-end">
                                <a href="{{ route('service-orders.index') }}"
                                    class="btn btn-light">Batal</a>

                                <button type="submit" class="btn btn-primary">
                                    Simpan & Masukkan Antrian
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layouts.footer')
</div>
@endsection

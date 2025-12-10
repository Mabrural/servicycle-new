@extends('layouts.main')

@section('container')
<div class="row col-6">
    <div class="col-lg-12">

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">

                <h4 class="fw-bold mb-1">
                    Tambah Kendaraan {{ ucfirst($type) }}
                </h4>
                <p class="text-muted mb-4">Isi data kendaraan dengan benar.</p>

                <form action="{{ route('vehicle.store') }}" method="POST">
                    @csrf

                    {{-- TIPE KENDARAAN --}}
                    <input type="hidden" name="jenis" value="{{ $type }}">

                    {{-- MEREK --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Merek</label>
                        <input type="text" name="merek" class="form-control" required>
                    </div>

                    {{-- MODEL --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" required>
                    </div>

                    {{-- TAHUN --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>

                    {{-- PLAT --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Nomor Plat</label>
                        <input type="text" name="plat" class="form-control" required>
                    </div>

                    {{-- ODOMETER --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Kilometer</label>
                        <input type="number" name="kilometer" class="form-control" required>
                    </div>

                    {{-- STNK --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Masa Berlaku STNK</label>
                        <input type="date" name="masa_stnk" class="form-control" required>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Simpan Kendaraan
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection

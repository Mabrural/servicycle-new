@extends('layouts.main')

@section('container')
    <div class="row justify-content-left mx-4 col-lg-12">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body px-4 py-4">

                    <h4 class="fw-bold mb-1">
                        Tambah Kendaraan {{ ucfirst($type) }}
                    </h4>
                    <p class="text-muted mb-4">Silakan isi informasi kendaraan dengan lengkap.</p>

                    <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf

                        {{-- TIPE KENDARAAN --}}
                        <input type="hidden" name="vehicle_type" value="{{ $type }}">

                        {{-- MEREK --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merek {{ ucfirst($type) }}</label>
                            <input type="text" name="brand" class="form-control" placeholder="Contoh: Toyota, Honda"
                                required>
                        </div>

                        {{-- MODEL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Model</label>
                            <input type="text" name="model" class="form-control" placeholder="Contoh: Avanza, Beat"
                                required>
                        </div>

                        {{-- TAHUN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tahun Kendaraan</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2020" required>
                        </div>

                        {{-- NOMOR PLAT --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Plat</label>
                            <input type="text" name="plate_number" class="form-control" placeholder="Contoh: BP 1234 XX"
                                required>
                        </div>

                        {{-- KILOMETER --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kilometer</label>
                            <input type="number" name="kilometer" class="form-control" placeholder="Contoh: 12000"
                                required>
                        </div>

                        {{-- MASA BERLAKU STNK --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Masa Berlaku STNK</label>
                            <input type="date" name="masa_berlaku_stnk" class="form-control" required>
                        </div>

                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                            Simpan Kendaraan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

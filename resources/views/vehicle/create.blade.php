@extends('layouts.main')

@section('container')
    <div class="row justify-content-start mx-4 col-lg-12">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body px-4 py-4">

                    <h4 class="fw-bold mb-1">
                        Tambah Kendaraan {{ ucfirst($type) }}
                    </h4>
                    <p class="text-muted mb-4">Silakan isi informasi kendaraan dengan lengkap.</p>

                    {{-- ALERT ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf

                        {{-- TIPE KENDARAAN --}}
                        <input type="hidden" name="vehicle_type" value="{{ $type }}">

                        {{-- ROW 1: BRAND & MODEL --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Merek {{ ucfirst($type) }}</label>
                                <input type="text" name="brand"
                                    class="form-control @error('brand') is-invalid @enderror"
                                    placeholder="Contoh: Toyota, Honda" value="{{ old('brand') }}" required>
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Model</label>
                                <input type="text" name="model"
                                    class="form-control @error('model') is-invalid @enderror"
                                    placeholder="Contoh: Avanza, Beat" value="{{ old('model') }}" required>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ROW 2: TAHUN & PLAT --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tahun Kendaraan</label>
                                <input type="number" name="tahun"
                                    class="form-control @error('tahun') is-invalid @enderror" placeholder="Contoh: 2020"
                                    value="{{ old('tahun') }}" required>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nomor Plat</label>
                                <input type="text" name="plate_number"
                                    class="form-control @error('plate_number') is-invalid @enderror"
                                    placeholder="Contoh: BP 1234 XX" value="{{ old('plate_number') }}" required>
                                @error('plate_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ROW 3: KILOMETER & MASA BERLAKU STNK --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Kilometer</label>
                                <input type="number" name="kilometer"
                                    class="form-control @error('kilometer') is-invalid @enderror"
                                    placeholder="Contoh: 12000" value="{{ old('kilometer') }}" required>
                                @error('kilometer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Masa Berlaku STNK</label>
                                <input type="date" name="masa_berlaku_stnk"
                                    class="form-control @error('masa_berlaku_stnk') is-invalid @enderror"
                                    value="{{ old('masa_berlaku_stnk') }}" required>
                                @error('masa_berlaku_stnk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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

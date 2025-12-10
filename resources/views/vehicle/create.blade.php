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

                        <input type="hidden" name="vehicle_type" value="{{ $type }}">

                        {{-- ROW 1 --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Merek {{ ucfirst($type) }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="brand"
                                    class="form-control @error('brand') is-invalid @enderror"
                                    placeholder="Contoh: Toyota, Honda" value="{{ old('brand') }}" required>
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Model <span class="text-danger">*</span></label>
                                <input type="text" name="model"
                                    class="form-control @error('model') is-invalid @enderror"
                                    placeholder="Contoh: Avanza, Beat" value="{{ old('model') }}" required>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ROW 2 --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tahun Kendaraan <span
                                        class="text-danger">*</span></label>

                                <select name="tahun" id="tahun"
                                    class="form-control select2 @error('tahun') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Tahun</option>

                                    @php
                                        $currentYear = date('Y');
                                    @endphp

                                    @for ($year = $currentYear; $year >= 1990; $year--)
                                        <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>

                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nomor Plat <span class="text-danger">*</span></label>
                                <input type="text" name="plate_number"
                                    class="form-control @error('plate_number') is-invalid @enderror"
                                    placeholder="Contoh: BP1234XX" value="{{ old('plate_number') }}" required>
                                @error('plate_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ROW 3 --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Kilometer</label>
                                <input type="text" name="kilometer"
                                    class="form-control @error('kilometer') is-invalid @enderror"
                                    placeholder="Contoh: 12000" value="{{ old('kilometer') }}">
                                @error('kilometer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Masa Berlaku STNK</label>
                                <input type="date" name="masa_berlaku_stnk"
                                    class="form-control @error('masa_berlaku_stnk') is-invalid @enderror"
                                    value="{{ old('masa_berlaku_stnk') }}">
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
        @include('layouts.footer')
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Agar select2 tingginya sama seperti form-control */
        .select2-container .select2-selection--single {
            height: 42px !important;
            display: flex !important;
            align-items: center !important;
            padding-left: 12px !important;
            border: 1px solid #ced4da !important;
            border-radius: 0.375rem !important;
        }

        /* Placeholder styling lebih rapi */
        .select2-selection__placeholder {
            color: #6c757d !important;
        }

        /* Arrow posisinya dipusatkan */
        .select2-selection__arrow {
            height: 100% !important;
            right: 10px !important;
            display: flex !important;
            align-items: center !important;
        }

        /* Dropdown tepat di bawah input */
        .select2-container--open .select2-dropdown {
            margin-top: 0 !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .select2-container {
                width: 100% !important;
            }
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Pilih Tahun",
                allowClear: false
            });
        });
    </script>
@endpush

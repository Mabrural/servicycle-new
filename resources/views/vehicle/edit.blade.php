@extends('layouts.main')

@section('container')
    <div class="row justify-content-start mx-4 col-lg-12">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body px-4 py-4">

                    <h4 class="fw-bold mb-1">
                        Edit Kendaraan {{ ucfirst($type) }}
                    </h4>
                    <p class="text-muted mb-4">Silakan perbarui informasi kendaraan.</p>

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

                    <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="vehicle_type" value="{{ $vehicle->vehicle_type }}">

                        {{-- ROW 1 --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Merek {{ ucfirst($type) }}
                                    <span class="text-danger">*</span></label>

                                <select name="brand" id="brand"
                                    class="form-control select2-brand @error('brand') is-invalid @enderror" required>
                                    <option value="">Pilih Merek</option>
                                </select>

                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Model <span class="text-danger">*</span></label>

                                <select name="model" id="model"
                                    class="form-control select2-model @error('model') is-invalid @enderror" required>
                                    <option value="">Pilih Model</option>
                                </select>

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
                                    <option value="" disabled>Pilih Tahun</option>

                                    @php $currentYear = date('Y'); @endphp

                                    @for ($year = $currentYear; $year >= 1990; $year--)
                                        <option value="{{ $year }}"
                                            {{ $vehicle->tahun == $year ? 'selected' : '' }}>
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
                                    value="{{ $vehicle->plate_number }}" required>

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
                                    value="{{ $vehicle->kilometer }}">

                                @error('kilometer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Masa Berlaku STNK</label>
                                <input type="date" name="masa_berlaku_stnk"
                                    class="form-control @error('masa_berlaku_stnk') is-invalid @enderror"
                                    value="{{ $vehicle->masa_berlaku_stnk }}">

                                @error('masa_berlaku_stnk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                            Update Kendaraan
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
        .select2-container .select2-selection--single {
            height: 42px !important;
            display: flex !important;
            align-items: center !important;
            padding-left: 12px !important;
            border: 1px solid #ced4da !important;
            border-radius: 0.375rem !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            const vehicleType = "{{ $type }}";
            const selectedBrand = "{{ $vehicle->brand }}";
            const selectedModel = "{{ $vehicle->model }}";

            const jsonURL =
                "https://raw.githubusercontent.com/Mabrural/dataset-kendaraan/refs/heads/master/vehicle_dataset.json?nocache=" +
                new Date().getTime();

            // INIT SELECT2
            $('#brand').select2({
                width: '100%',
                placeholder: "Pilih Merek"
            });
            $('#model').select2({
                width: '100%',
                placeholder: "Pilih Model"
            });
            $('#tahun').select2({
                width: '100%'
            });

            let dataset = {};

            // LOAD DATASET
            fetch(jsonURL)
                .then(res => res.json())
                .then(json => {
                    dataset = json[vehicleType];

                    let brandOptions = Object.keys(dataset).map(brand => ({
                        id: brand,
                        text: brand
                    }));

                    $('#brand').empty().append('<option value=""></option>').select2({
                        data: brandOptions,
                        width: '100%',
                        placeholder: "Pilih Merek",
                        allowClear: false
                    });

                    // SET SELECTED BRAND
                    $('#brand').val(selectedBrand).trigger('change');
                });

            // CHANGE BRAND → LOAD MODELS
            $('#brand').on('change', function() {
                let brand = $(this).val();
                let modelList = dataset[brand] ?? [];

                let modelOptions = modelList.map(m => ({
                    id: m,
                    text: m
                }));

                $('#model').empty().append('<option value=""></option>').select2({
                    data: modelOptions,
                    width: "100%",
                    placeholder: "Pilih Model",
                    allowClear: false
                });

                // SET SELECTED MODEL
                $('#model').val(selectedModel).trigger('change');
            });

        });
        document.addEventListener("DOMContentLoaded", function() {
            const plateInput = document.querySelector('input[name="plate_number"]');

            plateInput.addEventListener("input", function() {
                // Ubah huruf ke kapital dan hapus spasi
                let value = this.value.toUpperCase().replace(/\s+/g, '');

                this.value = value;
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const kmInput = document.querySelector('input[name="kilometer"]');

            kmInput.addEventListener("input", function() {
                // Hanya angka, hapus spasi & huruf
                let value = this.value.replace(/\D+/g, '');

                // Hilangkan leading zero (00055 → 55)
                value = value.replace(/^0+/, '');

                // Jika kosong setelah hapus leading zero, reset ke empty
                this.value = value;
            });
        });
    </script>
@endpush

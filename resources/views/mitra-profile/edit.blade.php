@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4 class="fw-bold">Edit Profil Bengkel</h4>
                    <p class="text-muted">Perbarui informasi bengkel Anda untuk memaksimalkan layanan ServiCycle.</p>
                </div>
            </div>

            @if ($mitra->count() == 0)
                <div class="alert alert-info">
                    <i class="mdi mdi-information-outline"></i> Anda belum memiliki data mitra.
                </div>
            @endif

            <div class="row">
                @foreach ($mitra as $item)
                    <div class="col-lg-8  mb-4">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body p-4">

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <h5 class="fw-bold text-dark mb-3">
                                    <i class="mdi mdi-storefront-outline me-1"></i>
                                    Edit: {{ $item->business_name }}
                                </h5>

                                <form action="{{ route('update.mitra', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Business Name --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Bengkel</label>
                                        <input type="text" name="business_name" class="form-control"
                                            value="{{ old('business_name', $item->business_name) }}">
                                    </div>

                                    {{-- Address --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                                        <textarea name="address" rows="3" class="form-control">{{ old('address', $item->address) }}</textarea>
                                    </div>

                                    {{-- Province & Regency --}}
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Provinsi</label>
                                            <input type="text" name="province" class="form-control"
                                                value="{{ old('province', $item->province) }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Kabupaten / Kota</label>
                                            <input type="text" name="regency" class="form-control"
                                                value="{{ old('regency', $item->regency) }}">
                                        </div>
                                    </div>

                                    {{-- Vehicle Types --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tipe Kendaraan Yang Dilayani</label>

                                        @php
                                            $selectedVehicles = is_array($item->vehicle_type)
                                                ? $item->vehicle_type
                                                : [$item->vehicle_type];
                                        @endphp

                                        <div class="form-group">

                                            <div class="vehicle-options d-flex gap-4">

                                                <label class="vehicle-checkbox">
                                                    <input type="checkbox" name="vehicle_type[]" value="motor"
                                                        {{ in_array('motor', $selectedVehicles) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">Motor</span>
                                                </label>

                                                <label class="vehicle-checkbox">
                                                    <input type="checkbox" name="vehicle_type[]" value="mobil"
                                                        {{ in_array('mobil', $selectedVehicles) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">Mobil</span>
                                                </label>

                                            </div>

                                            @error('vehicle_type')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        @error('vehicle_type')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Photo --}}
                                    {{-- <div class="mb-3">
                                        <label class="form-label fw-semibold">Foto Bengkel</label>
                                        <div class="mb-2">
                                            <img src="{{ asset('assets/images/bengkel-image.jpg') }}"
                                                class="img-fluid rounded" style="max-height:150px; object-fit:cover;">
                                        </div>
                                        <input type="file" name="photo" class="form-control">
                                    </div> --}}
                                    {{-- Longitude & Latitude --}}
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Latitude</label>
                                            <input type="text" name="latitude" class="form-control"
                                                value="{{ old('latitude', $item->latitude) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Longitude</label>
                                            <input type="text" name="longitude" class="form-control"
                                                value="{{ old('longitude', $item->longitude) }}">
                                        </div>

                                    </div>
                                     <a href="https://www.google.com/maps/dir/?api=1&destination={{ $item->latitude }},{{ $item->longitude }}"
                                        target="_blank">
                                        Arahkan ke Lokasi
                                    </a>

                                    {{-- Buttons --}}
                                    <div class="mt-4 d-flex justify-content-between">
                                        <a href="{{ route('profile.mitra') }}" class="btn btn-light px-4 rounded-pill">
                                            <i class="mdi mdi-arrow-left"></i> Kembali
                                        </a>

                                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        @include('layouts.footer')
    </div>
@endsection

@push('styles')
    <style>
        /* Container horizontal */
        .vehicle-options {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        /* Wrapper custom checkbox */
        .vehicle-checkbox {
            position: relative;
            padding-left: 40px;
            cursor: pointer;
            font-size: 1.05rem;
            user-select: none;
            display: flex;
            align-items: center;
        }

        /* Hide original checkbox */
        .vehicle-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Custom checkbox design */
        .vehicle-checkbox .checkmark {
            position: absolute;
            left: 0;
            height: 24px;
            width: 24px;
            background-color: #e9ecef;
            border-radius: 6px;
            border: 2px solid #bfc5ce;
            transition: all 0.2s ease;
        }

        /* Checkmark setelah dicentang */
        .vehicle-checkbox input:checked~.checkmark {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Tanda centang */
        .vehicle-checkbox .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Bikin centang */
        .vehicle-checkbox input:checked~.checkmark:after {
            display: block;
        }

        /* Bentuk centang */
        .vehicle-checkbox .checkmark:after {
            left: 7px;
            top: 2px;
            width: 7px;
            height: 14px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .vehicle-checkbox .label-text {
            margin-left: 10px;
        }
    </style>
@endpush

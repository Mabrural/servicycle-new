@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            @include('auth.layouts.brand-logo')

                            <h4>Daftar Mitra Bengkel</h4>
                            <h6 class="fw-light mb-3">
                                Bergabung sebagai mitra ServiCycle untuk mengelola servis, antrian,
                                dan pelanggan bengkel Anda secara digital.
                            </h6>

                            <form class="pt-3" method="POST" action="{{ route('register.mitra') }}">
                                @csrf

                                {{-- ROW 1: Nama Penanggung Jawab + Nomor HP --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                placeholder="Nama penanggung jawab" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="tel" name="phone"
                                                class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                placeholder="Nomor HP (contoh: 08xxxxxxxxxx)" value="{{ old('phone') }}"
                                                required>



                                            @error('phone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- ROW 2: Email + Nama Bengkel --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="Email resmi bengkel" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="business_name"
                                                class="form-control form-control-lg @error('business_name') is-invalid @enderror"
                                                placeholder="Nama bengkel" value="{{ old('business_name') }}" required>
                                            @error('business_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Password (full width) --}}
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Buat kata sandi" required>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Konfirmasi Password (full width) --}}
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                        placeholder="Konfirmasi kata sandi" required>
                                </div>

                                <hr class="my-4">

                                <h5 class="mb-3">Data Bengkel</h5>

                                {{-- Tipe Kendaraan (full width) --}}
                                <div class="form-group">
                                    <label class="mb-2 fw-bold">Tipe kendaraan yang dilayani:</label>

                                    <div class="vehicle-options d-flex gap-4">

                                        <label class="vehicle-checkbox">
                                            <input type="checkbox" name="vehicle_type[]" value="motor"
                                                @if (is_array(old('vehicle_type')) && in_array('motor', old('vehicle_type'))) checked @endif>
                                            <span class="checkmark"></span>
                                            <span class="label-text">Motor</span>
                                        </label>

                                        <label class="vehicle-checkbox">
                                            <input type="checkbox" name="vehicle_type[]" value="mobil"
                                                @if (is_array(old('vehicle_type')) && in_array('mobil', old('vehicle_type'))) checked @endif>
                                            <span class="checkmark"></span>
                                            <span class="label-text">Mobil</span>
                                        </label>

                                    </div>

                                    @error('vehicle_type')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- ROW 3: Provinsi + Kabupaten --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="province" id="province"
                                                class="form-control select2 @error('province') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Provinsi --</option>
                                            </select>

                                            @error('province')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="regency" id="regency"
                                                class="form-control select2 @error('regency') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Kabupaten / Kota --</option>
                                            </select>

                                            @error('regency')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Alamat (full width) --}}
                                <div class="form-group">
                                    <textarea name="address" rows="5" class="form-control form-control-lg @error('address') is-invalid @enderror"
                                        placeholder="Alamat lengkap bengkel" required>{{ old('address') }}</textarea>

                                    @error('address')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol Submit --}}
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                        DAFTAR SEBAGAI MITRA
                                    </button>
                                </div>

                                <div class="text-center mt-4 fw-light">
                                    Sudah terdaftar sebagai mitra?
                                    <a href="{{ route('login') }}" class="text-primary">Masuk ke Dashboard</a>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        .select2-selection__placeholder {
            color: #6c757d !important;
        }

        .select2-selection__arrow {
            height: 100% !important;
            right: 10px !important;
            display: flex !important;
            align-items: center !important;
        }

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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#province").select2({
                width: "100%",
                placeholder: "-- Pilih Provinsi --"
            });

            $("#regency").select2({
                width: "100%",
                placeholder: "-- Pilih Kabupaten / Kota --"
            });

            const savedProvince = "{{ old('province') }}";
            const savedRegency = "{{ old('regency') }}";

            // Load Provinsi
            async function loadProvinces() {
                try {
                    const res = await fetch(
                        "https://mabrural.github.io/api-wilayah-indonesia/api/provinces.json");
                    const provinces = await res.json();

                    let options = `<option value="">-- Pilih Provinsi --</option>`;

                    provinces.forEach(p => {
                        options +=
                            `<option value="${p.name}" ${savedProvince === p.name ? "selected" : ""}>${p.name}</option>`;
                    });

                    $("#province").html(options).trigger("change");

                } catch (err) {
                    console.log("Gagal memuat provinsi", err);
                }
            }

            // Load Kabupaten / Kota
            async function loadRegencies() {
                const provinceName = $("#province").val();
                if (!provinceName) return;

                $("#regency").html(`<option value="">Sedang memuat...</option>`).trigger("change");

                try {
                    const provinceRes = await fetch(
                        "https://mabrural.github.io/api-wilayah-indonesia/api/provinces.json");
                    const provinces = await provinceRes.json();
                    const selectedProvince = provinces.find(p => p.name === provinceName);

                    const regencyRes = await fetch(
                        `https://mabrural.github.io/api-wilayah-indonesia/api/regencies/${selectedProvince.id}.json`
                    );
                    const regencies = await regencyRes.json();

                    let options = `<option value="">-- Pilih Kabupaten / Kota --</option>`;

                    regencies.forEach(r => {
                        options +=
                            `<option value="${r.name}" ${savedRegency === r.name ? "selected" : ""}>${r.name}</option>`;
                    });

                    $("#regency").html(options).trigger("change");

                } catch (err) {
                    console.log("Gagal memuat kabupaten", err);
                }
            }

            // Load initial
            loadProvinces().then(() => {
                if (savedProvince) {
                    loadRegencies();
                }
            });

            $("#province").on("change", loadRegencies);

        });
    </script>
@endpush

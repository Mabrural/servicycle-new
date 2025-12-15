{{-- Mode Maps sudah bisa satelite dan maps --}}
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

                                    {{-- Provinsi + Kabupaten --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Provinsi</label>
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
                                            <label class="form-label fw-semibold">Kabupaten / Kota</label>
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

                                    {{-- maps --}}
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label fw-semibold mb-0">Pin Lokasi Bengkel</label>

                                            <button type="button" id="btnMyLocation"
                                                class="btn btn-sm btn-outline-primary rounded-pill">
                                                <i class="mdi mdi-crosshairs-gps"></i> Lokasi Saya
                                            </button>
                                        </div>

                                        <div id="map" style="height: 300px; border-radius: 12px;"></div>

                                        <small class="text-muted">
                                            Klik <b>Lokasi Saya</b> untuk mengambil lokasi saat ini atau geser pin secara
                                            manual.
                                        </small>
                                        <br>

                                        <small class="text-muted">
                                            Geser pin untuk menentukan lokasi bengkel secara akurat
                                        </small>
                                    </div>

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

                                    <hr>
                                    <h5 class="fw-bold mb-3">Foto Bengkel (Max 5)</h5>

                                    <div class="row g-3" id="imageGrid">

                                        @for ($i = 0; $i < 5; $i++)
                                            @php
                                                $image = $item->images->firstWhere('sort_order', $i);
                                            @endphp

                                            <div class="col-md-2">
                                                <div class="image-card {{ $i === 0 ? 'cover' : '' }}"
                                                    data-slot="{{ $i }}" data-mitra="{{ $item->id }}">

                                                    @if ($image)
                                                        <img src="{{ asset('storage/' . $image->image_path) }}">

                                                        <button type="button" class="btn-remove-image"
                                                            data-id="{{ $image->id }}"
                                                            data-slot="{{ $i }}">
                                                            <i class="mdi mdi-close"></i>
                                                        </button>
                                                    @else
                                                        <i class="mdi mdi-camera-plus-outline"></i>
                                                    @endif

                                                    <input type="file" class="image-input">
                                                </div>

                                                @if ($i === 0)
                                                    <small class="text-primary fw-semibold d-block text-center mt-1">
                                                        Cover (Wajib)
                                                    </small>
                                                @endif
                                            </div>
                                        @endfor


                                    </div>

                                    <div class="mt-3 mb-3">
                                        <label class="form-label fw-semibold">Deskripsi Bengkel</label>

                                        <textarea name="description" rows="7" class="custom-textarea"
                                            placeholder="Ceritakan singkat tentang bengkel Anda...">{{ old('description', $item->description) }}</textarea>
                                    </div>
                                    {{-- Services --}}
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Layanan Bengkel</label>
                                        <small class="text-muted d-block mb-2">
                                            Pilih layanan yang tersedia di bengkel Anda
                                        </small>

                                        @php
                                            $selectedServices = old(
                                                'services',
                                                is_array($item->services)
                                                    ? $item->services
                                                    : json_decode($item->services ?? '[]', true),
                                            );
                                        @endphp

                                        <div class="row" id="servicesContainer">
                                            <div class="col-12 text-muted">
                                                <i class="mdi mdi-loading mdi-spin"></i> Memuat layanan...
                                            </div>
                                        </div>

                                        @error('services')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr>
                                    <h5 class="fw-bold mb-3">Jam Operasional Bengkel</h5>

                                    @php
                                        $days = [
                                            'monday' => 'Senin',
                                            'tuesday' => 'Selasa',
                                            'wednesday' => 'Rabu',
                                            'thursday' => 'Kamis',
                                            'friday' => 'Jumat',
                                            'saturday' => 'Sabtu',
                                            'sunday' => 'Minggu',
                                            'national_holiday' => 'Libur Nasional',
                                        ];

                                        $operational = old('operational_hours', $item->operational_hours ?? []);
                                    @endphp

                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Buka?</th>
                                                    <th>Jam Buka</th>
                                                    <th>Jam Tutup</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($days as $key => $label)
                                                    @php
                                                        $day = $operational[$key] ?? ['open' => false];
                                                    @endphp
                                                    <tr>
                                                        <td class="fw-semibold">{{ $label }}</td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="operational_hours[{{ $key }}][open]"
                                                                value="1"
                                                                {{ $day['open'] ?? false ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="time"
                                                                name="operational_hours[{{ $key }}][start]"
                                                                class="form-control" value="{{ $day['start'] ?? '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="time"
                                                                name="operational_hours[{{ $key }}][end]"
                                                                class="form-control" value="{{ $day['end'] ?? '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />


    <style>
        .service-item {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            border: 1.5px solid #dee2e6;
            border-radius: 12px;
            cursor: pointer;
            transition: .2s;
            background: #fff;
        }

        .service-item:hover {
            border-color: #0d6efd;
        }

        .service-item input {
            margin-right: 10px;
            transform: scale(1.2);
        }

        .service-item.checked {
            background: #e7f1ff;
            border-color: #0d6efd;
        }

        .custom-textarea {
            width: 100%;
            min-height: 180px;
            /* tinggi nyaman di desktop */
            padding: 14px 16px;
            font-size: 0.95rem;
            line-height: 1.6;
            border-radius: 14px;
            border: 1.8px solid #ced4da;
            background-color: #fff;
            color: #212529;
            resize: vertical;
            /* user bisa tarik */
            transition: all 0.2s ease;
        }

        /* Fokus */
        .custom-textarea:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.12);
        }

        /* Placeholder */
        .custom-textarea::placeholder {
            color: #adb5bd;
            font-size: 0.9rem;
        }

        /* MOBILE OPTIMIZATION */
        @media (max-width: 768px) {
            .custom-textarea {
                min-height: 220px;
                /* lebih tinggi di HP */
                font-size: 1rem;
            }
        }

        .btn-remove-image {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: none;
            background: rgba(220, 53, 69, 0.9);
            color: #fff;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }

        .btn-remove-image:hover {
            background: #dc3545;
        }

        .image-card {
            position: relative;
            height: 120px;
            border: 2px dashed #ced4da;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f9fa;
        }

        .image-card.cover {
            border-color: #0d6efd;
        }

        .image-card i {
            font-size: 32px;
            color: #adb5bd;
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-card input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
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
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


    <script>
        document.addEventListener('change', function(e) {
            if (!e.target.classList.contains('image-input')) return;

            const card = e.target.closest('.image-card');
            const slot = card.dataset.slot;
            const mitraId = card.dataset.mitra;

            const formData = new FormData();
            formData.append('image', e.target.files[0]);
            formData.append('slot', slot);
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`/mitra/${mitraId}/images`, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    card.innerHTML = `
            <img src="${res.url}">
            <button type="button"
                class="btn-remove-image"
                data-id="${res.id}"
                data-slot="${slot}">
                <i class="mdi mdi-close"></i>
            </button>
            <input type="file" class="image-input">
        `;
                })
                .catch(() => alert('Upload gagal'));
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-remove-image');
            if (!btn) return;

            if (!confirm('Hapus gambar ini?')) return;

            const imageId = btn.dataset.id;
            const slot = btn.dataset.slot;
            const card = btn.closest('.image-card');

            fetch(`/mitra-images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    card.innerHTML = `
            <i class="mdi mdi-camera-plus-outline"></i>
            <input type="file" class="image-input">
        `;
                });
        });
    </script>

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

            const savedProvince = "{{ old('province', $item->province) }}";
            const savedRegency = "{{ old('regency', $item->regency) }}";


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

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let map, marker;

            const latInput = document.querySelector('input[name="latitude"]');
            const lngInput = document.querySelector('input[name="longitude"]');
            const btnMyLocation = document.getElementById("btnMyLocation");

            const savedLat = latInput.value ? parseFloat(latInput.value) : null;
            const savedLng = lngInput.value ? parseFloat(lngInput.value) : null;

            const fallbackLat = -6.200000;
            const fallbackLng = 106.816666;

            function setLatLng(lat, lng) {
                latInput.value = lat.toFixed(6);
                lngInput.value = lng.toFixed(6);

                if (marker) {
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 17);
                }
            }

            function initMap(lat, lng) {

                map = L.map('map', {
                    center: [lat, lng],
                    zoom: 17
                });

                // 🌍 NORMAL MAP
                const streetMap = L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }
                );

                // 🛰️ SATELLITE MAP (ESRI – FREE)
                const satelliteMap = L.tileLayer(
                    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                        attribution: 'Tiles © Esri'
                    }
                );

                // DEFAULT → SATELLITE
                satelliteMap.addTo(map);

                // Layer switcher
                L.control.layers({
                    "Satellite": satelliteMap,
                    "Map": streetMap
                }).addTo(map);

                // Marker
                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);

                setLatLng(lat, lng);

                marker.on('dragend', e => {
                    const pos = e.target.getLatLng();
                    setLatLng(pos.lat, pos.lng);
                });

                map.on('click', e => {
                    setLatLng(e.latlng.lat, e.latlng.lng);
                });

                // 🔍 SEARCH LOCATION
                const geocoder = L.Control.geocoder({
                        defaultMarkGeocode: false
                    })
                    .on('markgeocode', function(e) {
                        const center = e.geocode.center;
                        setLatLng(center.lat, center.lng);
                    })
                    .addTo(map);
            }

            function getCurrentLocation() {

                if (!navigator.geolocation) {
                    alert("Browser tidak mendukung GPS.");
                    return;
                }

                btnMyLocation.disabled = true;
                btnMyLocation.innerHTML =
                    '<i class="mdi mdi-loading mdi-spin"></i> Mengambil lokasi...';

                navigator.geolocation.getCurrentPosition(
                    pos => {
                        if (!map) {
                            initMap(pos.coords.latitude, pos.coords.longitude);
                        } else {
                            setLatLng(pos.coords.latitude, pos.coords.longitude);
                        }

                        btnMyLocation.disabled = false;
                        btnMyLocation.innerHTML =
                            '<i class="mdi mdi-crosshairs-gps"></i> Lokasi Saya';
                    },
                    err => {
                        alert("Izin lokasi ditolak / gagal.");
                        btnMyLocation.disabled = false;
                        btnMyLocation.innerHTML =
                            '<i class="mdi mdi-crosshairs-gps"></i> Lokasi Saya';
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000
                    }
                );
            }

            // INIT
            if (savedLat && savedLng) {
                initMap(savedLat, savedLng);
            } else {
                getCurrentLocation();
            }

            btnMyLocation.addEventListener("click", getCurrentLocation);

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", async function() {

            const container = document.getElementById("servicesContainer");
            const selectedServices = @json($selectedServices);

            function getVehicleTypes() {
                return Array.from(
                    document.querySelectorAll('input[name="vehicle_type[]"]:checked')
                ).map(el => el.value);
            }

            async function loadServices() {
                container.innerHTML = `
            <div class="col-12 text-muted">
                <i class="mdi mdi-loading mdi-spin"></i> Memuat layanan...
            </div>
        `;

                try {
                    const res = await fetch(
                        "https://raw.githubusercontent.com/Mabrural/dataset-services/refs/heads/master/services.json"
                    );
                    const data = await res.json();

                    const vehicleTypes = getVehicleTypes();
                    let services = [];

                    if (vehicleTypes.includes('mobil')) {
                        services = services.concat(data.services.car);
                    }

                    if (vehicleTypes.includes('motor')) {
                        services = services.concat(data.services.motorcycle);
                    }

                    // hilangkan duplikat
                    services = Object.values(
                        services.reduce((acc, s) => {
                            acc[s.key] = s;
                            return acc;
                        }, {})
                    );

                    container.innerHTML = "";

                    services.forEach(service => {
                        const checked = selectedServices.includes(service.key);

                        container.innerHTML += `
                    <div class="col-md-4 col-sm-6 mb-2">
                        <label class="service-item ${checked ? 'checked' : ''}">
                            <input type="checkbox"
                                   name="services[]"
                                   value="${service.key}"
                                   ${checked ? 'checked' : ''}>
                            ${service.name}
                        </label>
                    </div>
                `;
                    });

                    // efek checked
                    container.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                        cb.addEventListener('change', function() {
                            this.closest('.service-item')
                                .classList.toggle('checked', this.checked);
                        });
                    });

                } catch (err) {
                    container.innerHTML = `
                <div class="col-12 text-danger">
                    Gagal memuat layanan
                </div>
            `;
                    console.error(err);
                }
            }

            // Load pertama
            loadServices();

            // Reload saat vehicle type berubah
            document.querySelectorAll('input[name="vehicle_type[]"]').forEach(el => {
                el.addEventListener('change', loadServices);
            });

        });
    </script>
@endpush

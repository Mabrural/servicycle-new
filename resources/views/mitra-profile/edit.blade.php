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
                                                            data-id="{{ $image->id }}" data-slot="{{ $i }}">
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
                                        <textarea name="description" rows="7" class="form-control"
                                            placeholder="Ceritakan singkat tentang bengkel Anda...">{{ old('description', $item->description) }}</textarea>
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
    <style>
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
    </style>
@endpush

@push('scripts')
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
@endpush

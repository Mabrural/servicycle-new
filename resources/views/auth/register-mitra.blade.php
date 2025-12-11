@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            @include('auth.layouts.brand-logo')

                            <h4>Daftar Mitra Bengkel</h4>
                            <h6 class="fw-light mb-3">
                                Bergabung sebagai mitra ServiCycle untuk mengelola servis, antrian,
                                dan pelanggan bengkel Anda secara digital.
                            </h6>

                            <form class="pt-3" method="POST" action="{{ route('register.mitra') }}">
                                @csrf

                                {{-- Nama Penanggung Jawab --}}
                                <div class="form-group">
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Nama penanggung jawab bengkel" value="{{ old('name') }}" required>

                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nomor HP --}}
                                <div class="form-group">
                                    <input type="tel" name="phone"
                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                        placeholder="Nomor HP (contoh: 08xxxxxxxxxx)" value="{{ old('phone') }}" required>

                                    <small class="text-muted">
                                        Nomor akan otomatis disimpan dengan format 628xxxxxxxxxx
                                    </small>

                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email resmi bengkel" value="{{ old('email') }}" required>

                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Buat kata sandi" required>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Konfirmasi Password --}}
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                        placeholder="Konfirmasi kata sandi" required>
                                </div>

                                <hr class="my-4">

                                <h5 class="mb-3">Data Bengkel</h5>

                                {{-- Nama Bengkel --}}
                                <div class="form-group">
                                    <input type="text" name="business_name"
                                        class="form-control form-control-lg @error('business_name') is-invalid @enderror"
                                        placeholder="Nama bengkel" value="{{ old('business_name') }}" required>

                                    @error('business_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tipe Kendaraan --}}
                                <div class="form-group">
                                    <label class="mb-1">Tipe kendaraan yang dilayani:</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="vehicle_type[]" value="motor"
                                            id="motor" @if (is_array(old('vehicle_type')) && in_array('motor', old('vehicle_type'))) checked @endif>
                                        <label class="form-check-label" for="motor">Motor</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="vehicle_type[]" value="mobil"
                                            id="mobil" @if (is_array(old('vehicle_type')) && in_array('mobil', old('vehicle_type'))) checked @endif>
                                        <label class="form-check-label" for="mobil">Mobil</label>
                                    </div>

                                    @error('vehicle_type')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Provinsi --}}
                                <div class="form-group">
                                    <select name="province" id="province"
                                        class="form-control form-control-lg @error('province') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>

                                    @error('province')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kabupaten / Kota --}}
                                <div class="form-group">
                                    <select name="regency" id="regency"
                                        class="form-control form-control-lg @error('regency') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                    </select>

                                    @error('regency')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- Alamat --}}
                                <div class="form-group">
                                    <textarea name="address" rows="3" class="form-control form-control-lg @error('address') is-invalid @enderror"
                                        placeholder="Alamat lengkap bengkel" required>{{ old('address') }}</textarea>

                                    @error('address')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol --}}
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                        DAFTAR SEBAGAI MITRA
                                    </button>
                                </div>

                                {{-- Link Login --}}
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {

            // Load Provinsi
            async function loadProvinces() {
                const provinceSelect = document.getElementById('province');
                const savedProvince = "{{ old('province') }}";

                try {
                    const res = await fetch(
                        "https://mabrural.github.io/api-wilayah-indonesia/api/provinces.json");
                    const provinces = await res.json();

                    provinces.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.name;
                        option.textContent = p.name;

                        // jika ada old value (validasi gagal)
                        if (savedProvince === p.name) option.selected = true;

                        provinceSelect.appendChild(option);
                    });
                } catch (err) {
                    console.log("Gagal memuat provinsi", err);
                }
            }

            // Load Kabupaten saat Provinsi berubah
            async function loadRegencies() {
                const provinceName = document.getElementById('province').value;
                const regencySelect = document.getElementById('regency');
                const savedRegency = "{{ old('regency') }}";

                regencySelect.innerHTML = `<option value="">Sedang memuat...</option>`;

                if (!provinceName) return;

                try {
                    // Fetch ID provinsi dulu
                    const provinceRes = await fetch(
                        "https://mabrural.github.io/api-wilayah-indonesia/api/provinces.json");
                    const provinces = await provinceRes.json();
                    const selectedProvince = provinces.find(p => p.name === provinceName);

                    if (!selectedProvince) return;

                    // Fetch kabupaten berdasarkan province_id
                    const regencyRes = await fetch(
                        `https://mabrural.github.io/api-wilayah-indonesia/api/regencies/${selectedProvince.id}.json`
                    );
                    const regencies = await regencyRes.json();

                    regencySelect.innerHTML = `<option value="">-- Pilih Kabupaten / Kota --</option>`;

                    regencies.forEach(r => {
                        const option = document.createElement('option');
                        option.value = r.name;
                        option.textContent = r.name;

                        if (savedRegency === r.name) option.selected = true;

                        regencySelect.appendChild(option);
                    });
                } catch (err) {
                    console.log("Gagal memuat kabupaten", err);
                }
            }

            // Load provinsi saat halaman dibuka
            await loadProvinces();

            // Kalau user sebelumnya sudah memilih provinsi → load regency otomatis
            if ("{{ old('province') }}") {
                await loadRegencies();
            }

            // Event onChange
            document.getElementById('province').addEventListener('change', loadRegencies);

        });
    </script>
@endpush

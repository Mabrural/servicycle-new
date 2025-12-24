@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-12">
                    <div class="home-tab">

                        {{-- HEADER --}}
                        <div class="mb-4 border-bottom pb-2">
                            <h4 class="fw-bold mb-1">Harga & Paket Subscription Pro</h4>
                            <p class="text-muted mb-0">
                                Atur harga paket Pro untuk Customer dan Mitra
                            </p>
                        </div>

                        {{-- CARD --}}
                        <div class="card card-rounded shadow-sm">
                            <div class="card-body">

                                <form method="POST" action="{{ route('admin.subscription.settings.update') }}">
                                    @csrf

                                    {{-- ================= STATUS TOGGLE ================= --}}
                                    <div class="mb-4">
                                        <label class="form-label fw-bold d-block mb-2">
                                            Status Fitur Subscription
                                        </label>

                                        <div
                                            class="d-flex align-items-center justify-content-between flex-wrap gap-2 p-3 border rounded">

                                            <div>
                                                <span class="fw-semibold d-block">
                                                    {{ $setting->is_enabled ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                                <small class="text-muted">
                                                    Jika nonaktif, semua user dianggap <strong>FREE</strong>
                                                </small>
                                            </div>

                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_enabled" value="1" id="isEnabled"
                                                    {{ $setting->is_enabled ? 'checked' : '' }}>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>

                                    {{-- ================= HARGA CUSTOMER ================= --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Harga Customer Premium (per bulan)
                                        </label>

                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="customer_price" class="form-control"
                                                value="{{ old('customer_price', $setting->customer_price) }}"
                                                min="0">
                                        </div>

                                        <small class="text-muted">
                                            Isi <strong>0</strong> jika Customer boleh klaim Pro gratis
                                        </small>
                                    </div>

                                    {{-- ================= HARGA MITRA ================= --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Harga Mitra Premium (per bulan)
                                        </label>

                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="mitra_price" class="form-control"
                                                value="{{ old('mitra_price', $setting->mitra_price) }}" min="0">
                                        </div>

                                        <small class="text-muted">
                                            Isi <strong>0</strong> jika Mitra boleh klaim Pro gratis
                                        </small>
                                    </div>

                                    <hr>

                                    {{-- ================= INFO ================= --}}
                                    <div class="alert alert-info">
                                        <ul class="mb-0 ps-3">
                                            <li>User tanpa data subscription → <strong>FREE</strong></li>
                                            <li>Harga 0 → bisa klaim tanpa pembayaran</li>
                                            <li>Coupon & lifetime tetap override harga</li>
                                        </ul>
                                    </div>

                                    {{-- ================= ACTION ================= --}}
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary text-white px-4">
                                            <i class="mdi mdi-content-save me-1"></i>
                                            Simpan Pengaturan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection

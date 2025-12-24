@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 col-md-6 mx-auto">
                        <div class="auth-form-light">

                            @include('auth.layouts.brand-logo')

                            {{-- ================= PRO ACTIVE ================= --}}
                            @if ($subscription && $subscription->isActive())
                                <div class="text-center py-3">
                                    <i class="mdi mdi-crown text-success fs-3 mb-2"></i>
                                    <h6 class="fw-semibold mb-1">Akun PRO Aktif</h6>

                                    <p class="small text-muted mb-3">
                                        @if ($subscription->is_lifetime)
                                            Akses seumur hidup
                                        @elseif($subscription->expired_at)
                                            Aktif hingga {{ $subscription->expired_at->format('d M Y') }}
                                        @endif
                                    </p>

                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                                        Ke Dashboard
                                    </a>
                                </div>

                                {{-- ================= UPGRADE ================= --}}
                            @else
                                <h5 class="text-center fw-semibold mb-1">Upgrade ke PRO</h5>
                                <p class="text-center text-muted small mb-4">
                                    Aktifkan fitur premium tanpa batas
                                </p>

                                {{-- Price --}}
                                <div class="text-center mb-4">
                                    @if ($price == 0)
                                        <div class="fw-bold fs-3 text-success">
                                            Gratis
                                        </div>
                                        <span class="badge bg-success-subtle text-success small mt-1">
                                            Gratis 1 Bulan Pertama
                                        </span>
                                    @else
                                        <div class="fw-bold fs-3 text-primary">
                                            Rp {{ number_format($price, 0, ',', '.') }}
                                        </div>
                                        <div class="text-muted small">
                                            / bulan · {{ ucfirst($user->role) }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Features --}}
                                <ul class="list-unstyled small mb-4">
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="mdi mdi-check text-success me-2"></i>
                                        Semua fitur premium
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="mdi mdi-check text-success me-2"></i>
                                        Tanpa batas layanan
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="mdi mdi-check text-success me-2"></i>
                                        Support prioritas
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="mdi mdi-check text-success me-2"></i>
                                        Update fitur terbaru
                                    </li>
                                </ul>

                                {{-- Form --}}
                                <form method="POST" action="{{ route('subscription.process') }}">
                                    @csrf

                                    {{-- Coupon --}}
                                    <div class="mb-3">
                                        <label class="form-label small fw-medium">Kode Kupon</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="coupon_code" class="form-control"
                                                placeholder="Kode promo" value="{{ old('coupon_code') }}">
                                            <button class="btn btn-outline-secondary text-dark" type="button"
                                                id="applyCoupon">
                                                Terapkan
                                            </button>
                                        </div>

                                        @error('coupon_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- CTA --}}
                                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                        @if ($price == 0)
                                            Aktifkan Gratis
                                        @else
                                            Upgrade Sekarang
                                        @endif
                                    </button>

                                    {{-- Info gratis --}}
                                    @if ($price == 0)
                                        <div class="text-center mt-2">
                                            <small class="text-success">
                                                <i class="mdi mdi-information-outline"></i>
                                                Tidak perlu pembayaran di bulan pertama
                                            </small>
                                        </div>
                                    @endif

                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            <i class="mdi mdi-shield-check"></i>
                                            Pembayaran aman
                                        </small>
                                    </div>
                                </form>

                                <div class="text-center mt-4">
                                    <a href="{{ route('dashboard') }}" class="small text-decoration-none text-muted">
                                        Kembali ke dashboard
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .auth-form-light {
            background: #fff;
            border-radius: 8px;
            padding: 1.75rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .04);
        }

        .auth-form-light h5 {
            letter-spacing: -.2px;
        }

        .form-control {
            font-size: 0.875rem;
            border-radius: 6px;
        }

        .btn {
            border-radius: 6px;
        }

        .list-unstyled li {
            font-size: 0.875rem;
        }

        .bg-success-subtle {
            background-color: rgba(46, 204, 113, 0.12);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('applyCoupon');
            const input = document.querySelector('input[name="coupon_code"]');

            if (btn && input) {
                btn.addEventListener('click', function() {
                    if (!input.value.trim()) {
                        input.focus();
                        return;
                    }

                    btn.disabled = true;
                    btn.innerHTML = '...';

                    setTimeout(() => {
                        btn.disabled = false;
                        btn.innerHTML = 'Terapkan';
                    }, 1000);
                });
            }
        });
    </script>
@endpush

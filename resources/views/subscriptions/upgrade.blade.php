@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            @include('auth.layouts.brand-logo')

                            @if ($subscription && $subscription->isActive())
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-crown mdi-48px text-success"></i>
                                    </div>
                                    <h4 class="fw-bold text-success mb-3">
                                        🎉 Akun Anda Sudah PRO
                                    </h4>
                                    <div class="alert alert-success border-0 bg-success-subtle mb-4">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-check-circle me-2"></i>
                                            <div class="flex-grow-1">
                                                <strong>Status Aktif</strong>
                                                @if ($subscription->is_lifetime)
                                                    <div class="small">Akses seumur hidup</div>
                                                @elseif($subscription->expired_at)
                                                    <div class="small">
                                                        Berlaku hingga: {{ $subscription->expired_at->format('d F Y') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                                            <i class="mdi mdi-home me-1"></i> Kembali ke Dashboard
                                        </a>
                                    </div>
                                </div>
                            @else
                                <h4 class="text-center mb-1">Upgrade ke PRO</h4>
                                <p class="text-center text-muted mb-4">
                                    Buka semua fitur premium untuk pengalaman terbaik
                                </p>

                                {{-- Price Card --}}
                                <div class="card border-primary mb-4">
                                    <div class="card-body text-center py-4">
                                        <div class="mb-3">
                                            <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">HOT DEAL</span>
                                            <h2 class="display-5 fw-bold text-primary mb-1">
                                                Rp {{ number_format($price, 0, ',', '.') }}
                                            </h2>
                                            <p class="text-muted mb-0">/ bulan</p>
                                            <small class="text-muted">Untuk akun {{ ucfirst($user->role) }}</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Features --}}
                                <div class="mb-4">
                                    <h6 class="fw-semibold mb-3">Fitur yang Didapat:</h6>
                                    <div class="d-grid gap-2">
                                        <div class="d-flex align-items-center p-2 border rounded">
                                            <i class="mdi mdi-check-circle text-success me-3"></i>
                                            <span>Akses semua fitur premium</span>
                                        </div>
                                        <div class="d-flex align-items-center p-2 border rounded">
                                            <i class="mdi mdi-check-circle text-success me-3"></i>
                                            <span>Tanpa batasan layanan</span>
                                        </div>
                                        <div class="d-flex align-items-center p-2 border rounded">
                                            <i class="mdi mdi-check-circle text-success me-3"></i>
                                            <span>Support prioritas 24/7</span>
                                        </div>
                                        <div class="d-flex align-items-center p-2 border rounded">
                                            <i class="mdi mdi-check-circle text-success me-3"></i>
                                            <span>Update fitur terbaru</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Form --}}
                                <form class="pt-3" method="POST" action="{{ route('subscription.process') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label fw-medium mb-2">
                                            <i class="mdi mdi-ticket-percent me-1"></i>
                                            Kode Kupon (Opsional)
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="coupon_code" class="form-control form-control-lg"
                                                placeholder="Masukkan kode kupon" value="{{ old('coupon_code') }}">
                                            <button class="btn btn-outline-secondary text-dark" type="button"
                                                id="applyCoupon">
                                                Terapkan
                                            </button>
                                        </div>
                                        @error('coupon_code')
                                            <div class="text-danger small mt-2">
                                                <i class="mdi mdi-alert-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Terms --}}
                                    <div class="form-check mb-4 mt-3">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label small" for="agreeTerms">
                                            Saya menyetujui
                                            <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                                            dan
                                            <a href="#" class="text-decoration-none">Kebijakan Privasi</a>
                                        </label>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="mt-3 d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                            <i class="mdi mdi-arrow-up-circle me-2"></i>
                                            UPGRADE SEKARANG
                                        </button>
                                    </div>

                                    {{-- Security Info --}}
                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            <i class="mdi mdi-shield-check me-1"></i>
                                            Pembayaran aman & terenkripsi
                                        </small>
                                    </div>
                                </form>

                                {{-- Back Link --}}
                                <div class="text-center mt-4 fw-light">
                                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                                        <i class="mdi mdi-arrow-left me-1"></i>
                                        Kembali ke dashboard
                                    </a>
                                </div>
                            @endif

                            {{-- Support Link --}}
                            @if (!($subscription && $subscription->isActive()))
                                <div class="text-center mt-4">
                                    <small class="text-muted">
                                        Butuh bantuan?
                                        <a href="#" class="text-primary text-decoration-none">Hubungi Support</a>
                                    </small>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Styles untuk konsisten dengan template auth */
        .auth-form-light {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .auth-form-btn {
            padding: 0.75rem 2rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .border-primary {
            border-color: #4b7bec !important;
        }

        .bg-success-subtle {
            background-color: rgba(46, 204, 113, 0.1) !important;
        }

        /* Feature boxes styling */
        .d-grid.gap-2>div {
            transition: all 0.2s ease;
        }

        .d-grid.gap-2>div:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        /* Coupon button styling */
        #applyCoupon {
            border-color: #ced4da;
            font-weight: 500;
        }

        #applyCoupon:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-lg-6 {
                max-width: 90% !important;
            }

            .px-sm-5 {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }

            .display-5 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .col-lg-6 {
                max-width: 95% !important;
            }

            .auth-form-light {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .display-5 {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coupon apply button
            const applyCouponBtn = document.getElementById('applyCoupon');
            const couponInput = document.querySelector('input[name="coupon_code"]');

            if (applyCouponBtn && couponInput) {
                applyCouponBtn.addEventListener('click', function() {
                    if (couponInput.value.trim() === '') {
                        couponInput.focus();
                        couponInput.classList.add('is-invalid');
                        setTimeout(() => {
                            couponInput.classList.remove('is-invalid');
                        }, 2000);
                        return;
                    }

                    // Simulate API call
                    applyCouponBtn.disabled = true;
                    const originalText = applyCouponBtn.innerHTML;
                    applyCouponBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1"></span> Memproses...';

                    setTimeout(() => {
                        applyCouponBtn.disabled = false;
                        applyCouponBtn.innerHTML = originalText;

                        // Show success
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Kupon berhasil diterapkan!'
                        });
                    }, 1500);
                });
            }

            // Form validation
            const form = document.querySelector('form');
            const agreeTerms = document.getElementById('agreeTerms');

            if (form && agreeTerms) {
                form.addEventListener('submit', function(e) {
                    if (!agreeTerms.checked) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Persetujuan Diperlukan',
                            text: 'Harap setujui Syarat & Ketentuan terlebih dahulu',
                            confirmButtonColor: '#4b7bec',
                            confirmButtonText: 'Mengerti'
                        });
                        agreeTerms.focus();
                    }
                });
            }
        });
    </script>
@endpush

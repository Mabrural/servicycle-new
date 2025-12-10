@extends('auth.layouts.main')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center py-5 px-4 px-sm-5">

                        {{-- Logo --}}
                        @include('auth.layouts.brand-logo')

                        {{-- Heading --}}
                        <h3 class="fw-bold mb-2">Selamat Datang di ServiCycle</h3>
                        <p class="fw-light mb-4">
                            Kelola servis kendaraan Anda dengan mudah, cepat, dan terorganisir.
                        </p>

                        {{-- Button Login --}}
                        <div class="mt-3 d-grid gap-2">
                            <a href="{{ route('login') }}"
                               class="btn btn-primary btn-lg fw-medium">
                                MASUK
                            </a>
                        </div>

                        {{-- Button Register --}}
                        <div class="mt-3 d-grid gap-2">
                            <a href="{{ route('register') }}"
                               class="btn btn-outline-primary btn-lg fw-medium">
                                DAFTAR AKUN
                            </a>
                        </div>

                        {{-- Optional text --}}
                        <div class="text-center mt-4 fw-light text-muted">
                            Bengkel & pemilik kendaraan ✅
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
</div>
@endsection

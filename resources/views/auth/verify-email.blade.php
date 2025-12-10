@extends('auth.layouts.main')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                        <!-- LOGO -->
                        @include('auth.layouts.brand-logo')

                        <h4>Verifikasi Alamat Email</h4>
                        <h6 class="fw-light">
                            Terima kasih telah mendaftar! Sebelum melanjutkan, silakan verifikasi email Anda
                            melalui link yang sudah kami kirimkan. Jika belum menerima email, Anda dapat meminta
                            kiriman ulang.
                        </h6>

                        {{-- STATUS: Jika link verifikasi sudah dikirim --}}
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success small mt-3">
                                Link verifikasi baru telah dikirim ke alamat email Anda.
                            </div>
                        @endif

                        <!-- FORM RESEND VERIFICATION -->
                        <form class="pt-3" method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                    KIRIM ULANG EMAIL VERIFIKASI
                                </button>
                            </div>
                        </form>

                        <!-- FORM LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-light btn-lg fw-medium auth-form-btn">
                                    KELUAR
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
</div>
@endsection

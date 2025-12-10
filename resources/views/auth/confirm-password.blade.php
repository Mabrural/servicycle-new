@extends('auth.layouts.main')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                        {{-- LOGO --}}
                        @include('auth.layouts.brand-logo')

                        <h4>Konfirmasi Kata Sandi</h4>
                        <h6 class="fw-light">
                            Demi keamanan, silakan masukkan kembali kata sandi Anda sebelum melanjutkan.
                        </h6>

                        <!-- FORM CONFIRM PASSWORD -->
                        <form class="pt-3" method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            {{-- Password --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Masukkan kata sandi"
                                    required autofocus>

                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Konfirmasi --}}
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                    KONFIRMASI
                                </button>
                            </div>

                            {{-- Tombol Kembali ke Dashboard atau Logout Opsional --}}
                            <div class="text-center mt-3 fw-light">
                                <a href="{{ url()->previous() }}" class="text-primary">Kembali</a>
                            </div>

                        </form>
                        <!-- END FORM -->

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
</div>
@endsection

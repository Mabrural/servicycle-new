@extends('auth.layouts.main')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="../../assets/images/logo.svg" alt="logo">
                        </div>

                        <h4>Selamat datang!</h4>
                        <h6 class="fw-light">Silakan masuk untuk melanjutkan.</h6>

                        <!-- FORM LOGIN -->
                        <form class="pt-3" method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Email / Username --}}
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Alamat Email"
                                    value="{{ old('email') }}"
                                    required autofocus>

                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Kata Sandi"
                                    required>

                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Sign In --}}
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                    MASUK
                                </button>
                            </div>

                            {{-- Remember Me + Lupa Password --}}
                            <div class="my-2 d-flex justify-content-between align-items-center">

                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" name="remember" class="form-check-input">
                                        Ingat saya
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link text-black">
                                    Lupa kata sandi?
                                </a>
                                @endif
                            </div>

                            {{-- Register --}}
                            <div class="text-center mt-4 fw-light">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-primary">Daftar</a>
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

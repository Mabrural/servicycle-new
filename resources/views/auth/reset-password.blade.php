@extends('auth.layouts.main')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                        @include('auth.layouts.brand-logo')

                        <h4>Reset Kata Sandi</h4>
                        <h6 class="fw-light">Silakan buat kata sandi baru untuk akun Anda.</h6>

                        <!-- FORM RESET PASSWORD -->
                        <form class="pt-3" method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Token Reset -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- Email --}}
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Alamat Email"
                                    value="{{ old('email', $request->email) }}"
                                    required autofocus>

                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Kata Sandi Baru"
                                    required>

                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control form-control-lg"
                                    placeholder="Konfirmasi Kata Sandi Baru"
                                    required>
                            </div>

                            {{-- Tombol Reset --}}
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">
                                    RESET PASSWORD
                                </button>
                            </div>

                            {{-- Kembali ke login --}}
                            <div class="text-center mt-4 fw-light">
                                Sudah ingat kata sandi?
                                <a href="{{ route('login') }}" class="text-primary">Masuk</a>
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

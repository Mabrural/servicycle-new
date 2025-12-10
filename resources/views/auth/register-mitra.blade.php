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

                        <!-- FORM REGISTER MITRA -->
                        <form class="pt-3" method="POST" action="{{ route('register.mitra') }}">
                            @csrf

                            {{-- Nama Penanggung Jawab --}}
                            <div class="form-group">
                                <input type="text"
                                    name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Nama penanggung jawab bengkel"
                                    value="{{ old('name') }}"
                                    required autofocus>

                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email Bengkel --}}
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Email resmi bengkel"
                                    value="{{ old('email') }}"
                                    required>

                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Buat kata sandi"
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
                                    placeholder="Konfirmasi kata sandi"
                                    required>
                            </div>

                            {{-- Tombol Daftar --}}
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
                        <!-- END FORM -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

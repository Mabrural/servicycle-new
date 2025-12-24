@extends('auth.layouts.main')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">

                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            {{-- Logo --}}
                            @include('auth.layouts.brand-logo')

                            <div class="mb-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">
                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                </a>
                            </div>


                            <h4>Profil Akun</h4>
                            <h6 class="fw-light mb-4">Kelola informasi akun dan keamanan Anda.</h6>

                            {{-- ================= PROFILE INFORMATION ================= --}}
                            <form method="POST" action="{{ route('profile.update') }}" class="mb-5">
                                @csrf
                                @method('patch')

                                <h5 class="mb-3">Informasi Profil</h5>

                                {{-- Name --}}
                                <div class="form-group">
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Nama Lengkap" value="{{ old('name', $user->name) }}" required
                                        autofocus>

                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Alamat Email" value="{{ old('email', $user->email) }}" required>

                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Email verification --}}
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div class="mt-2 small text-warning">
                                            Email belum diverifikasi.
                                            <button form="send-verification"
                                                class="btn btn-link p-0 align-baseline text-primary">
                                                Kirim ulang verifikasi
                                            </button>
                                        </div>

                                        @if (session('status') === 'verification-link-sent')
                                            <div class="text-success small mt-1">
                                                Link verifikasi baru telah dikirim.
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="mt-3 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Simpan Profil
                                    </button>
                                </div>

                                @if (session('status') === 'profile-updated')
                                    <div class="text-success small mt-2">
                                        Profil berhasil diperbarui.
                                    </div>
                                @endif
                            </form>

                            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <hr>

                            {{-- ================= UPDATE PASSWORD ================= --}}
                            <form method="POST" action="{{ route('password.update') }}" class="my-5">
                                @csrf
                                @method('put')

                                <h5 class="mb-3">Ubah Kata Sandi</h5>

                                {{-- Current Password --}}
                                <div class="form-group">
                                    <input type="password" name="current_password"
                                        class="form-control form-control-lg @error('current_password', 'updatePassword') is-invalid @enderror"
                                        placeholder="Kata Sandi Saat Ini">

                                    @error('current_password', 'updatePassword')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- New Password --}}
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password', 'updatePassword') is-invalid @enderror"
                                        placeholder="Kata Sandi Baru">

                                    @error('password', 'updatePassword')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                        placeholder="Konfirmasi Kata Sandi Baru">
                                </div>

                                <div class="mt-3 d-grid">
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        Perbarui Kata Sandi
                                    </button>
                                </div>

                                @if (session('status') === 'password-updated')
                                    <div class="text-success small mt-2">
                                        Kata sandi berhasil diperbarui.
                                    </div>
                                @endif
                            </form>

                            <hr>

                            {{-- ================= DELETE ACCOUNT ================= --}}
                            <form method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')

                                <h5 class="mb-2 text-danger">Hapus Akun</h5>
                                <p class="small text-muted">
                                    Tindakan ini akan menghapus akun dan seluruh data secara permanen.
                                </p>

                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password', 'userDeletion') is-invalid @enderror"
                                        placeholder="Masukkan kata sandi untuk konfirmasi">

                                    @error('password', 'userDeletion')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3 d-grid">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        Hapus Akun Permanen
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

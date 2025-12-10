@extends('auth.layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row justify-content-center mt-5">
            <div class="col-md-6">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-3">Lupa Kata Sandi</h4>
                        <p class="text-muted mb-4">
                            Masukkan alamat email yang terdaftar. Kami akan mengirimkan link untuk mengatur ulang password Anda.
                        </p>

                        {{-- Success Message --}}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Form --}}
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    Kirim Link Reset Kata Sandi
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

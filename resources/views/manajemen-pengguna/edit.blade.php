@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-rounded mt-3">
                        <div class="card-body">

                            <h4 class="card-title card-title-dash">
                                Edit Pengguna
                            </h4>
                            <p class="card-subtitle card-subtitle-dash">
                                Perbarui data pengguna di bawah ini
                            </p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $user->phone) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>
                                                Customer
                                            </option>
                                            <option value="mitra" {{ $user->role == 'mitra' ? 'selected' : '' }}>
                                                Mitra
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Password Baru
                                            <small class="text-muted">(Kosongkan jika tidak diganti)</small>
                                        </label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password baru">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Konfirmasi Password Baru
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Ulangi password baru">
                                    </div>

                                </div>

                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
                                        Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection

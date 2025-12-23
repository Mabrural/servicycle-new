@extends('layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    {{-- TAB HEADER --}}
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0"
                                   id="users-tab"
                                   data-bs-toggle="tab"
                                   href="#users"
                                   role="tab"
                                   aria-selected="true">
                                    Manajemen Pengguna
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   id="stats-tab"
                                   data-bs-toggle="tab"
                                   href="#stats"
                                   role="tab"
                                   aria-selected="false">
                                    Statistik
                                </a>
                            </li>
                        </ul>
                        <div class="btn-wrapper">
                            {{-- future button --}}
                        </div>
                    </div>

                    <div class="tab-content tab-content-basic">

                        {{-- TAB DATA USER --}}
                        <div class="tab-pane fade show active" id="users" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-rounded mt-3">
                                        <div class="card-body">

                                            <h4 class="card-title card-title-dash">
                                                Data Pengguna
                                            </h4>
                                            <p class="card-subtitle card-subtitle-dash">
                                                Menampilkan {{ $users->count() }} pengguna terdaftar
                                            </p>

                                            <div class="table-responsive mt-4">
                                                <table class="table table-hover align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>No. HP</th>
                                                            <th>Role</th>
                                                            <th>Tanggal Dibuat</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($users as $index => $user)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <strong>{{ $user->name }}</strong>
                                                                </td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->phone ?? '-' }}</td>
                                                                <td>
                                                                    <span class="badge bg-primary">
                                                                        {{ ucfirst($user->role) }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <a href="#" class="btn btn-warning btn-sm">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        <a href="#" class="btn btn-danger btn-sm">
                                                                            <i class="mdi mdi-delete"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">
                                                                    <div class="alert alert-info mb-0">
                                                                        <i class="mdi mdi-information-outline me-2"></i>
                                                                        Belum ada data pengguna.
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB STATISTIK USER --}}
                        <div class="tab-pane fade" id="stats" role="tabpanel">
                            <div class="row mt-3">

                                <div class="col-md-4">
                                    <div class="card bg-primary text-white card-rounded">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="text-white">Total Pengguna</h6>
                                                    <h2 class="fw-bold">{{ $users->count() }}</h2>
                                                </div>
                                                <i class="mdi mdi-account-multiple mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-success text-white card-rounded">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="text-white">Admin</h6>
                                                    <h2 class="fw-bold">
                                                        {{ $users->where('role', 'admin')->count() }}
                                                    </h2>
                                                </div>
                                                <i class="mdi mdi-shield-account mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-warning text-white card-rounded">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="text-white">User</h6>
                                                    <h2 class="fw-bold">
                                                        {{ $users->where('role', 'user')->count() }}
                                                    </h2>
                                                </div>
                                                <i class="mdi mdi-account mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>
@endsection

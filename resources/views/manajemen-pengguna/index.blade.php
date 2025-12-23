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
                                    <a class="nav-link active ps-0" data-bs-toggle="tab" href="#users">
                                        Manajemen Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#stats">
                                        Statistik
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content tab-content-basic">

                            {{-- TAB DATA USER --}}
                            <div class="tab-pane fade show active" id="users">
                                <div class="card card-rounded mt-3">
                                    <div class="card-body">

                                        <h4 class="card-title card-title-dash">Data Pengguna</h4>
                                        <p class="card-subtitle card-subtitle-dash">
                                            Menampilkan {{ $users->total() }} pengguna
                                        </p>

                                        {{-- FILTER --}}
                                        <form method="GET" class="row g-2 mb-3">
                                            <div class="col-md-4">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Cari nama, email, atau no HP"
                                                    value="{{ request('search') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                                    @foreach ([10, 15, 20, 50, 100] as $size)
                                                        <option value="{{ $size }}"
                                                            {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                                            {{ $size }} / halaman
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <button class="btn btn-primary text-white w-100">
                                                    <i class="mdi mdi-magnify"></i> Cari
                                                </button>
                                            </div>
                                        </form>

                                        {{-- TABLE --}}
                                        <div class="table-responsive">
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
                                                            <td>{{ $users->firstItem() + $index }}</td>
                                                            <td><strong>{{ $user->name }}</strong></td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge bg-primary">
                                                                    {{ ucfirst($user->role) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $user->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="mdi mdi-pencil text-white"></i>
                                                                    </a>

                                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                                        method="POST" class="delete-user-form d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-sm">
                                                                            <i class="mdi mdi-delete text-white"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">
                                                                <div class="alert alert-info mb-0">
                                                                    <i class="mdi mdi-information-outline me-2"></i>
                                                                    Data tidak ditemukan
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- CUSTOM PAGINATION --}}
                                        @if ($users->hasPages())
                                            <div class="custom-pagination-wrapper mt-4">
                                                <ul class="custom-pagination">

                                                    {{-- PREVIOUS --}}
                                                    @if ($users->onFirstPage())
                                                        <li class="disabled">
                                                            <span>&laquo;</span>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ $users->previousPageUrl() }}"
                                                                rel="prev">&laquo;</a>
                                                        </li>
                                                    @endif

                                                    {{-- PAGE NUMBERS --}}
                                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                                        @if ($page == $users->currentPage())
                                                            <li class="active">
                                                                <span>{{ $page }}</span>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                    {{-- NEXT --}}
                                                    @if ($users->hasMorePages())
                                                        <li>
                                                            <a href="{{ $users->nextPageUrl() }}"
                                                                rel="next">&raquo;</a>
                                                        </li>
                                                    @else
                                                        <li class="disabled">
                                                            <span>&raquo;</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>

                            {{-- TAB STATISTIK --}}
                            <div class="tab-pane fade" id="stats">
                                <div class="row mt-3">

                                    <div class="col-md-3">
                                        <div class="card bg-primary text-white card-rounded">
                                            <div class="card-body">
                                                <h6>Total Pengguna</h6>
                                                <h2 class="fw-bold">{{ $users->total() }}</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card bg-success text-white card-rounded">
                                            <div class="card-body">
                                                <h6>Admin</h6>
                                                <h2 class="fw-bold">
                                                    {{ \App\Models\User::where('role', 'admin')->count() }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card bg-warning text-white card-rounded">
                                            <div class="card-body">
                                                <h6>Customer</h6>
                                                <h2 class="fw-bold">
                                                    {{ \App\Models\User::where('role', 'customer')->count() }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card bg-info text-white card-rounded">
                                            <div class="card-body">
                                                <h6>Mitra</h6>
                                                <h2 class="fw-bold">
                                                    {{ \App\Models\User::where('role', 'mitra')->count() }}
                                                </h2>
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

@push('styles')
    <style>
        .custom-pagination-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        .custom-pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .custom-pagination li {
            min-width: 36px;
            height: 36px;
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-pagination li a,
        .custom-pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            color: #6c757d;
            background: #f8f9fa;
            transition: all 0.2s ease;
        }

        .custom-pagination li a:hover {
            background: #0d6efd;
            color: #fff;
        }

        .custom-pagination li.active span {
            background: #0d6efd;
            color: #fff;
        }

        .custom-pagination li.disabled span {
            background: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
        }

        /* MOBILE FRIENDLY */
        @media (max-width: 576px) {
            .custom-pagination-wrapper {
                justify-content: center;
            }

            .custom-pagination li {
                min-width: 32px;
                height: 32px;
            }
        }
    </style>
@endpush


@push('scripts')
    <script>
        document.querySelectorAll('.delete-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Pengguna?',
                    text: 'Data pengguna akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Ya, Hapus',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview"
                                        role="tab" aria-controls="overview" aria-selected="true">Daftar Mitra</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                                        role="tab" aria-selected="false">Statistik</a>
                                </li>
                            </ul>
                            <div>
                                <div class="btn-wrapper">
                                    {{-- <a href="{{ route('mitra.create') }}" class="btn btn-primary text-white me-0">
                                    <i class="mdi mdi-plus"></i> Tambah Mitra
                                </a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card card-rounded mt-3">
                                            <div class="card-body">
                                                <h4 class="card-title card-title-dash">Data Mitra</h4>
                                                <p class="card-subtitle card-subtitle-dash">
                                                    Menampilkan {{ $mitras->count() ?? 0 }} mitra yang Anda buat
                                                </p>

                                                @if (session('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('error') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <div class="table-responsive mt-4">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Usaha</th>
                                                                <th>Tipe Kendaraan</th>
                                                                <th>Provinsi</th>
                                                                <th>Kabupaten/Kota</th>
                                                                <th>Status</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($mitras as $index => $mitra)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>
                                                                        <strong>{{ $mitra->business_name }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (is_array($mitra->vehicle_type))
                                                                            @foreach ($mitra->vehicle_type as $vehicle)
                                                                                <span
                                                                                    class="badge bg-info me-1">{{ $vehicle }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span
                                                                                class="badge bg-secondary">{{ $mitra->vehicle_type ?? '-' }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $mitra->province ?? '-' }}</td>
                                                                    <td>{{ $mitra->regency ?? '-' }}</td>
                                                                    <td>
                                                                        @if ($mitra->is_active)
                                                                            <span class="badge bg-success">Aktif</span>
                                                                        @else
                                                                            <span class="badge bg-danger">Tidak Aktif</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group" role="group">
                                                                            <a href="{{ route('mitra.show', $mitra->slug) }}"
                                                                                class="btn btn-info btn-sm">
                                                                                <i class="mdi mdi-eye"></i>
                                                                            </a>

                                                                            {{-- JIKA BELUM AKTIF → VERIFIKASI --}}
                                                                            @if (!$mitra->is_active)
                                                                                <form
                                                                                    action="{{ route('mitra.verify', $mitra->id) }}"
                                                                                    method="POST"
                                                                                    class="d-inline verify-form">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-success btn-sm">
                                                                                        <i class="mdi mdi-check"></i>
                                                                                    </button>
                                                                                </form>
                                                                            @else
                                                                                {{-- JIKA SUDAH AKTIF → NONAKTIFKAN --}}
                                                                                <form
                                                                                    action="{{ route('mitra.deactivate', $mitra->id) }}"
                                                                                    method="POST"
                                                                                    class="d-inline deactivate-form">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger btn-sm">
                                                                                        <i class="mdi mdi-cancel"></i>
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="8" class="text-center">
                                                                        <div class="alert alert-info">
                                                                            <i class="mdi mdi-information-outline me-2"></i>
                                                                            Belum ada data mitra.
                                                                            <a href="{{ route('mitra.create') }}"
                                                                                class="text-primary">Klik disini</a> untuk
                                                                            menambahkan mitra baru.
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

                            <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="profile-tab">
                                @if ($mitras->isEmpty())
                                    <div class="alert alert-info mt-4">
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        Belum ada data mitra untuk ditampilkan statistik.
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-8 d-flex flex-column">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <h4 class="card-title card-title-dash">Statistik Mitra</h4>
                                                            <div class="row mt-4">
                                                                <div class="col-md-4">
                                                                    <div class="card bg-primary text-white">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <h6 class="text-white">Total Mitra</h6>
                                                                                    <h2 class="fw-bold">
                                                                                        {{ $mitras->count() }}
                                                                                    </h2>
                                                                                </div>
                                                                                <div class="icon-shape">
                                                                                    <i
                                                                                        class="mdi mdi-account-group mdi-36px"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card bg-success text-white">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <h6 class="text-white">Mitra Aktif</h6>
                                                                                    <h2 class="fw-bold">
                                                                                        {{ $mitras->where('is_active', true)->count() }}
                                                                                    </h2>
                                                                                </div>
                                                                                <div class="icon-shape">
                                                                                    <i
                                                                                        class="mdi mdi-check-circle mdi-36px"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card bg-warning text-white">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <h6 class="text-white">Mitra Nonaktif
                                                                                    </h6>
                                                                                    <h2 class="fw-bold">
                                                                                        {{ $mitras->where('is_active', false)->count() }}
                                                                                    </h2>
                                                                                </div>
                                                                                <div class="icon-shape">
                                                                                    <i
                                                                                        class="mdi mdi-alert-circle mdi-36px"></i>
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

                                        <div class="col-lg-4 d-flex flex-column">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <h4 class="card-title card-title-dash">Distribusi Provinsi</h4>
                                                            @if ($mitras->count() > 0)
                                                                <div class="mt-3">
                                                                    <ul class="list-group">
                                                                        @foreach ($mitras->groupBy('province') as $province => $items)
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                                {{ $province ?? 'Tidak ada provinsi' }}
                                                                                <span
                                                                                    class="badge bg-primary rounded-pill">{{ $items->count() }}</span>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-warning mt-3">
                                                                    <i class="mdi mdi-alert me-2"></i>
                                                                    Tidak ada data untuk ditampilkan
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->

        @include('layouts.footer')
    </div>

    @push('scripts')
        <script>
            // Script untuk toggle tab
            $(document).ready(function() {
                $('.nav-tabs a').on('click', function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // VERIFIKASI
                document.querySelectorAll('.verify-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Verifikasi Bengkel?',
                            text: 'Status mitra akan menjadi AKTIF',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Verifikasi',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });

                // NONAKTIFKAN
                document.querySelectorAll('.deactivate-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Nonaktifkan Bengkel?',
                            text: 'Mitra tidak akan tampil sebagai bengkel aktif',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Nonaktifkan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });

            });
        </script>
    @endpush
@endsection

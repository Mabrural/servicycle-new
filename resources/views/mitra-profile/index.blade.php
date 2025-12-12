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
                                        role="tab" aria-controls="overview" aria-selected="true">Profil Bengkel</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">

                                {{-- Alert --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                {{-- Jika tidak ada mitra --}}
                                @if ($mitras->count() == 0)
                                    <div class="alert alert-info mt-4">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Belum ada mitra terdaftar.
                                        <a href="{{ route('mitra.create') }}" class="text-primary">Tambah mitra
                                            sekarang</a>.
                                    </div>
                                @endif

                                <div class="row mt-4">

                                    @foreach ($mitras as $mitra)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card card-rounded shadow-sm h-100">
                                                <div class="card-body">

                                                    {{-- Nama Usaha --}}
                                                    <h4 class="fw-bold">{{ $mitra->business_name }}</h4>

                                                    {{-- Status --}}
                                                    <span
                                                        class="badge {{ $mitra->is_active ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $mitra->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>

                                                    <hr>

                                                    {{-- Vehicle Type --}}
                                                    <p class="text-muted mb-1">Tipe Kendaraan:</p>
                                                    @if (is_array($mitra->vehicle_type))
                                                        @foreach ($mitra->vehicle_type as $vehicle)
                                                            <span
                                                                class="badge bg-info text-dark me-1">{{ $vehicle }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-secondary">{{ $mitra->vehicle_type }}</span>
                                                    @endif

                                                    <hr>

                                                    {{-- Lokasi --}}
                                                    <p class="mb-1">
                                                        <i class="mdi mdi-map-marker-outline me-1"></i>
                                                        {{ $mitra->province ?? '-' }} — {{ $mitra->regency ?? '-' }}
                                                    </p>

                                                    {{-- Alamat --}}
                                                    <p class="text-muted">
                                                        <i class="mdi mdi-home-map-marker me-1"></i>
                                                        {{ Str::limit($mitra->address, 80) }}
                                                    </p>

                                                    {{-- Aksi --}}
                                                    <div class="mt-3 d-flex justify-content-end gap-2">
                                                        <a href="#" class="btn btn-info btn-sm">
                                                            <i class="mdi mdi-eye"></i>
                                                            Detail
                                                        </a>
                                                        <a href="#" class="btn btn-warning btn-sm">
                                                            <i class="mdi mdi-pencil"></i>
                                                            Edit
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div> {{-- end overview --}}
                        </div>

                    </div>
                </div>
            </div>

        </div>

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
    @endpush
@endsection

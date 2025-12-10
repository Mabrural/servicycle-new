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
                                    <a class="nav-link active ps-0" data-bs-toggle="tab" href="#mobil"
                                        role="tab">Mobil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#motor" role="tab">Motor</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content tab-content-basic">

                            {{-- TAB MOBIL --}}
                            <div class="tab-pane fade show active" id="mobil" role="tabpanel">

                                <a href="{{ route('vehicle.create') }}?type=mobil" class="btn btn-primary mb-3 text-white">
                                    + Tambah Mobil
                                </a>

                                {{-- ✔ PESAN JIKA BELUM ADA DATA MOBIL --}}
                                @if ($vehicles->where('vehicle_type', 'mobil')->isEmpty())
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center py-4 rounded-3 shadow-sm">
                                            <h5 class="mb-1">Belum Ada Data Mobil</h5>
                                            <p class="mb-2">Silakan tambahkan kendaraan baru untuk mulai mengisi data.</p>

                                            <a href="{{ route('vehicle.create') }}?type=mobil"
                                                class="btn btn-primary mb-3 text-white">
                                                + Tambah Mobil
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    @foreach ($vehicles->where('vehicle_type', 'mobil') as $vehicle)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card p-4 shadow-sm" style="border-radius: 15px;">

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="font-weight-bold mb-0">Informasi Kendaraan</h4>
                                                    <span class="badge bg-primary p-2" style="border-radius: 8px;">
                                                        <i class="mdi mdi-car"></i>
                                                    </span>
                                                </div>

                                                <div class="vehicle-info-list">
                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-star-circle text-primary me-1"></i> Merek
                                                            Mobil
                                                        </p>
                                                        <h4>{{ $vehicle->brand }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-car-sports text-primary me-1"></i> Model Mobil
                                                        </p>
                                                        <h4>{{ $vehicle->model }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-calendar text-primary me-1"></i> Tahun
                                                        </p>
                                                        <h4>{{ $vehicle->tahun }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-numeric text-primary me-1"></i> Nomor Plat
                                                        </p>
                                                        <h4>{{ $vehicle->plate_number }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-counter text-primary me-1"></i> Kilometer
                                                        </p>
                                                        <h4>{{ number_format($vehicle->kilometer)  }} km</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-calendar-clock text-primary me-1"></i>
                                                            Masa Berlaku STNK
                                                        </p>
                                                        <h4>
                                                            {{ $vehicle->masa_berlaku_stnk ? \Carbon\Carbon::parse($vehicle->masa_berlaku_stnk)->format('d F Y') : '-' }}
                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-pencil me-1"></i> Edit
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('vehicle.destroy', $vehicle->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus?')"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="mdi mdi-delete me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            {{-- TAB MOTOR --}}
                            <div class="tab-pane fade" id="motor" role="tabpanel">

                                <a href="{{ route('vehicle.create') }}?type=motor" class="btn btn-primary mb-3 text-white">
                                    + Tambah Motor
                                </a>

                                {{-- ✔ PESAN JIKA BELUM ADA DATA MOTOR --}}
                                @if ($vehicles->where('vehicle_type', 'motor')->isEmpty())
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center py-4 rounded-3 shadow-sm">
                                            <h5 class="mb-1">Belum Ada Data Motor</h5>
                                            <p class="mb-2">Silakan tambahkan kendaraan baru untuk mulai mengisi data.</p>

                                            <a href="{{ route('vehicle.create') }}?type=motor"
                                                class="btn btn-primary mb-3 text-white">
                                                + Tambah Motor
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    @foreach ($vehicles->where('vehicle_type', 'motor') as $vehicle)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card p-4 shadow-sm" style="border-radius: 15px;">

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="font-weight-bold mb-0">Informasi Kendaraan</h4>
                                                    <span class="badge bg-primary p-2" style="border-radius: 8px;">
                                                        <i class="mdi mdi-motorbike"></i>
                                                    </span>
                                                </div>

                                                <div class="vehicle-info-list">

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-star-circle text-primary me-1"></i> Merek
                                                            Motor
                                                        </p>
                                                        <h4>{{ $vehicle->brand }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-motorbike text-primary me-1"></i> Model Motor
                                                        </p>
                                                        <h4>{{ $vehicle->model }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-calendar text-primary me-1"></i> Tahun
                                                        </p>
                                                        <h4>{{ $vehicle->tahun }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-numeric text-primary me-1"></i> Nomor Plat
                                                        </p>
                                                        <h4>{{ $vehicle->plate_number }}</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-counter text-primary me-1"></i> Kilometer
                                                        </p>
                                                        <h4>{{ number_format($vehicle->kilometer) }} km</h4>
                                                    </div>

                                                    <div class="mb-3">
                                                        <p class="statistics-title text-muted mb-1">
                                                            <i class="mdi mdi-calendar-clock text-primary me-1"></i>
                                                            Masa Berlaku STNK
                                                        </p>
                                                        <h4>
                                                            {{ $vehicle->masa_berlaku_stnk ? \Carbon\Carbon::parse($vehicle->masa_berlaku_stnk)->format('d F Y') : '-' }}
                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-pencil me-1"></i> Edit
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('vehicle.destroy', $vehicle->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus?')"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="mdi mdi-delete me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
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

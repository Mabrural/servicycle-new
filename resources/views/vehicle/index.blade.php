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
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#mobil"
                                        role="tab" aria-controls="mobil" aria-selected="true">Mobil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#motor"
                                        role="tab" aria-selected="false">Motor</a>
                                </li>

                            </ul>

                        </div>

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="mobil" role="tabpanel" aria-labelledby="mobil">
                                <a href="">Tambah Mobil</a>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card p-4 shadow-sm" style="border-radius: 15px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="font-weight-bold mb-0">Informasi Kendaraan</h4>

                                                <span class="badge bg-primary text-white p-2" style="border-radius: 8px;">
                                                    <i class="mdi mdi-car"></i>
                                                </span>
                                            </div>

                                            <!-- Items -->
                                            <div class="vehicle-info-list">

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-star-circle text-primary me-1"></i> Merek Mobil
                                                    </p>
                                                    <h4 class="rate-percentage">Toyota</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-car-sports text-primary me-1"></i> Model Mobil
                                                    </p>
                                                    <h4 class="rate-percentage">Avanza G</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-calendar text-primary me-1"></i> Tahun
                                                    </p>
                                                    <h4 class="rate-percentage">2021</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-numeric text-primary me-1"></i> Nomor Plat
                                                    </p>
                                                    <h4 class="rate-percentage">BP 1234 XX</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-counter text-primary me-1"></i> Kilometer
                                                    </p>
                                                    <h4 class="rate-percentage">45.200 km</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-calendar-clock text-primary me-1"></i> Masa
                                                        Berlaku STNK
                                                    </p>
                                                    <h4 class="rate-percentage">12 Desember 2025</h4>
                                                </div>

                                            </div>

                                            <!-- ACTION BUTTONS -->
                                            <div class="d-flex justify-content-between mt-4">

                                                <!-- EDIT -->
                                                <a href="#" class="btn btn-warning btn-sm d-flex align-items-center"
                                                    style="border-radius: 8px;">
                                                    <i class="mdi mdi-pencil me-1"></i> Edit
                                                </a>

                                                <!-- DELETE -->
                                                <form method="POST" action="#">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center"
                                                        style="border-radius: 8px;"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="mdi mdi-delete me-1"></i> Hapus
                                                    </button>
                                                </form>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="motor" role="tabpanel" aria-labelledby="motor">

                                <div class="row">
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card p-4 shadow-sm" style="border-radius: 15px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="font-weight-bold mb-0">Informasi Kendaraan</h4>

                                                <span class="badge bg-primary text-white p-2" style="border-radius: 8px;">
                                                    <i class="mdi mdi-car"></i>
                                                </span>
                                            </div>

                                            <!-- Items -->
                                            <div class="vehicle-info-list">

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-star-circle text-primary me-1"></i> Merek Motor
                                                    </p>
                                                    <h4 class="rate-percentage">Suzuki</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-car-sports text-primary me-1"></i> Model Motor
                                                    </p>
                                                    <h4 class="rate-percentage">Satria F150</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-calendar text-primary me-1"></i> Tahun
                                                    </p>
                                                    <h4 class="rate-percentage">2016</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-numeric text-primary me-1"></i> Nomor Plat
                                                    </p>
                                                    <h4 class="rate-percentage">BP6042GQ</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-counter text-primary me-1"></i> Kilometer
                                                    </p>
                                                    <h4 class="rate-percentage">45.200 km</h4>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="statistics-title text-muted mb-1">
                                                        <i class="mdi mdi-calendar-clock text-primary me-1"></i> Masa
                                                        Berlaku STNK
                                                    </p>
                                                    <h4 class="rate-percentage">12 Desember 2025</h4>
                                                </div>

                                            </div>

                                            <!-- ACTION BUTTONS -->
                                            <div class="d-flex justify-content-between mt-4">

                                                <!-- EDIT -->
                                                <a href="#" class="btn btn-warning btn-sm d-flex align-items-center"
                                                    style="border-radius: 8px;">
                                                    <i class="mdi mdi-pencil me-1"></i> Edit
                                                </a>

                                                <!-- DELETE -->
                                                <form method="POST" action="#">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center"
                                                        style="border-radius: 8px;"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="mdi mdi-delete me-1"></i> Hapus
                                                    </button>
                                                </form>

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
        <!-- content-wrapper ends -->
        @include('layouts.footer')
    </div>
@endsection

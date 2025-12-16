@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4 class="fw-bold">{{ $mitra->business_name }}</h4>
                    <p class="text-muted">Detail Profil Bengkel Mitra</p>
                </div>
            </div>

            <div class="row">
                {{-- Informasi Umum --}}
                <div class="col-md-8">
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Informasi Bengkel</h5>

                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%">Alamat</td>
                                    <td>: {{ $mitra->address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>: {{ $mitra->province ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kab/Kota</td>
                                    <td>: {{ $mitra->regency ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        :
                                        @if ($mitra->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Layanan --}}
                    <div class="card card-rounded mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Layanan Tersedia</h5>

                            @if (is_array($mitra->services) && count($mitra->services))
                                @foreach ($mitra->services as $service)
                                    <span class="badge bg-info me-1 mb-1">{{ $service }}</span>
                                @endforeach
                            @else
                                <p class="text-muted">Tidak ada data layanan</p>
                            @endif
                        </div>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Fasilitas</h5>

                            @if (is_array($mitra->facilities) && count($mitra->facilities))
                                <ul class="list-unstyled">
                                    @foreach ($mitra->facilities as $facility)
                                        <li>
                                            <i class="mdi mdi-check-circle text-success"></i>
                                            {{ $facility }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Tidak ada fasilitas terdaftar</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Jam Operasional --}}
                <div class="col-md-4">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Jam Operasional</h5>

                            @php
                                $days = [
                                    'monday' => 'Senin',
                                    'tuesday' => 'Selasa',
                                    'wednesday' => 'Rabu',
                                    'thursday' => 'Kamis',
                                    'friday' => 'Jumat',
                                    'saturday' => 'Sabtu',
                                    'sunday' => 'Minggu',
                                ];
                            @endphp

                            <ul class="list-group list-group-flush">
                                @foreach ($days as $key => $label)
                                    @php $day = $mitra->operational_hours[$key] ?? null; @endphp
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ $label }}</span>
                                        <span class="text-muted">
                                            @if ($day && ($day['open'] ?? false))
                                                {{ $day['start'] }} - {{ $day['end'] }}
                                            @else
                                                Tutup
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <hr>

                            {{-- Status buka sekarang --}}
                            @if ($mitra->isOpenNow())
                                <span class="badge bg-success w-100 text-center py-2">
                                    Sedang Buka
                                </span>
                            @else
                                <span class="badge bg-danger w-100 text-center py-2">
                                    Sedang Tutup
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.footer')
    </div>
@endsection

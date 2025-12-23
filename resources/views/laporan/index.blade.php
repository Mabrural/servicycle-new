@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">

                    <div class="home-tab">
                        {{-- Header Tabs --}}
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" id="laporan-tab" data-bs-toggle="tab" href="#laporan"
                                        role="tab">
                                        Laporan Servis
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="statistik-tab" data-bs-toggle="tab" href="#statistik"
                                        role="tab">
                                        Statistik & Grafik
                                    </a>
                                </li>
                            </ul>

                            <div class="btn-wrapper">
                                <a target="_blank" href="{{ route('laporan.bengkel.pdf', request()->query()) }}"
                                    class="btn btn-danger text-white">
                                    <i class="mdi mdi-file-pdf"></i> Download PDF
                                </a>
                            </div>
                        </div>

                        <div class="tab-content tab-content-basic">

                            {{-- ================= TAB LAPORAN ================= --}}
                            <div class="tab-pane fade show active" id="laporan" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card card-rounded mt-3">
                                            <div class="card-body">

                                                <h4 class="card-title card-title-dash">
                                                    📊 Laporan Bengkel - {{ $mitra->business_name ?? '-' }}
                                                </h4>
                                                <p class="card-subtitle card-subtitle-dash">
                                                    Riwayat servis berdasarkan periode
                                                </p>

                                                {{-- Filter --}}
                                                <form method="GET" class="row g-3 mt-3 mb-4">
                                                    <div class="col-md-3">
                                                        <label>Dari Tanggal</label>
                                                        <input type="date" name="start_date" value="{{ $start }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Sampai Tanggal</label>
                                                        <input type="date" name="end_date" value="{{ $end }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Tampilkan</label>
                                                        <select name="per_page" class="form-select"
                                                            onchange="this.form.submit()">
                                                            @foreach ([10, 15, 20, 50, 100] as $size)
                                                                <option value="{{ $size }}"
                                                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                                                    {{ $size }} data
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 d-flex align-items-end">
                                                        <button class="btn btn-primary text-white">
                                                            <i class="mdi mdi-filter text-white"></i> Filter
                                                        </button>
                                                    </div>

                                                </form>

                                                {{-- Table --}}
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Customer</th>
                                                                <th>No HP</th>
                                                                <th>Kendaraan</th>
                                                                <th>Status</th>
                                                                <th>Tanggal</th>
                                                                <th>Biaya</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($orders as $index => $o)
                                                                <tr>
                                                                    <td>{{ $orders->firstItem() + $index }}</td>
                                                                    <td>{{ $o->customer_name ?? '-' }}</td>
                                                                    <td>{{ $o->customer_phone ?? '-' }}</td>
                                                                    <td>
                                                                        @if ($o->vehicle)
                                                                            {{ $o->vehicle->brand }}
                                                                            {{ $o->vehicle->model }}
                                                                        @elseif($o->vehicle_brand_manual)
                                                                            {{ $o->vehicle_brand_manual }}
                                                                            {{ $o->vehicle_model_manual }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            $colors = [
                                                                                'pending' => 'secondary',
                                                                                'accepted' => 'info',
                                                                                'checked_in' => 'primary',
                                                                                'in_progress' => 'warning',
                                                                                'done' => 'success',
                                                                                'cancelled' => 'danger',
                                                                                'no_show' => 'danger',
                                                                            ];
                                                                        @endphp
                                                                        <span
                                                                            class="badge bg-{{ $colors[$o->status] ?? 'secondary' }}">
                                                                            {{ strtoupper($o->status) }}
                                                                        </span>
                                                                    </td>
                                                                    <td>{{ $o->created_at->format('d M Y H:i') }}</td>
                                                                    <td>
                                                                        @if ($o->final_cost)
                                                                            Rp
                                                                            {{ number_format($o->final_cost, 0, ',', '.') }}
                                                                        @elseif($o->estimated_cost)
                                                                            <small class="text-muted">
                                                                                Estimasi: Rp
                                                                                {{ number_format($o->estimated_cost, 0, ',', '.') }}
                                                                            </small>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7" class="text-center">
                                                                        <div class="alert alert-info">
                                                                            Tidak ada data servis
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- CUSTOM PAGINATION --}}
                                                @if ($orders->hasPages())
                                                    <div class="custom-pagination-wrapper mt-4">
                                                        <ul class="custom-pagination">

                                                            {{-- PREVIOUS --}}
                                                            @if ($orders->onFirstPage())
                                                                <li class="disabled">
                                                                    <span>&laquo;</span>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <a href="{{ $orders->previousPageUrl() }}"
                                                                        rel="prev">&laquo;</a>
                                                                </li>
                                                            @endif

                                                            {{-- PAGE NUMBERS --}}
                                                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                                                @if ($page == $orders->currentPage())
                                                                    <li class="active">
                                                                        <span>{{ $page }}</span>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a
                                                                            href="{{ $url }}">{{ $page }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                            {{-- NEXT --}}
                                                            @if ($orders->hasMorePages())
                                                                <li>
                                                                    <a href="{{ $orders->nextPageUrl() }}"
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
                                </div>
                            </div>

                            {{-- ================= TAB STATISTIK ================= --}}
                            <div class="tab-pane fade" id="statistik" role="tabpanel">
                                <div class="row mt-3">

                                    {{-- Statistik Cards --}}
                                    @foreach ($stats as $label => $value)
                                        <div class="col-md-3 mb-3">
                                            <div class="card bg-primary text-white">
                                                <div class="card-body">
                                                    <h6 class="text-white">
                                                        {{ ucfirst(str_replace('_', ' ', $label)) }}
                                                    </h6>
                                                    <h2 class="fw-bold">{{ $value }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Grafik --}}
                                    <div class="col-12">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <h4 class="card-title card-title-dash">
                                                    Grafik Servis Harian
                                                </h4>
                                                <canvas id="serviceChart" height="100"></canvas>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('serviceChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chart->keys()) !!},
                    datasets: [{
                        label: 'Jumlah Servis',
                        data: {!! json_encode($chart->values()) !!},
                        backgroundColor: '#4B49AC'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush

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

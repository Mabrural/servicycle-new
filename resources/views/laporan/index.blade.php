@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <h4 class="fw-bold mb-3">📊 Laporan Bengkel - {{ $mitra->business_name ?? '-' }}</h4>

        {{-- Filter --}}
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label>Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $start }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $end }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary me-2">Filter</button>
                <a target="_blank"
                    href="{{ route('laporan.bengkel.pdf', array_merge(request()->query(), ['start_date' => $start, 'end_date' => $end])) }}"
                    class="btn btn-danger">
                    Download PDF
                </a>
            </div>
        </form>

        {{-- Statistik --}}
        <div class="row mb-4">
            @foreach ($stats as $label => $value)
                <div class="col-md-2 mb-3">
                    <div class="card shadow-sm text-center h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $label)) }}</h6>
                            <h3 class="fw-bold text-primary">{{ $value }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Grafik --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Grafik Servis Harian</h5>
            </div>
            <div class="card-body">
                <canvas id="serviceChart" height="100"></canvas>
            </div>
        </div>

        {{-- Table --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Servis</h5>
                <small>Total: {{ $orders->count() }} pesanan</small>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>No. HP</th>
                            <th>Kendaraan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $o)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $o->customer_name ?? '-' }}</td>
                                <td>{{ $o->customer_phone ?? '-' }}</td>
                                <td>
                                    @if ($o->vehicle)
                                        {{ $o->vehicle->brand }} {{ $o->vehicle->model }}
                                    @elseif($o->vehicle_brand_manual)
                                        {{ $o->vehicle_brand_manual }} {{ $o->vehicle_model_manual }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'secondary',
                                            'accepted' => 'info',
                                            'rejected' => 'danger',
                                            'checked_in' => 'primary',
                                            'waiting' => 'warning',
                                            'in_progress' => 'primary',
                                            'done' => 'success',
                                            'picked_up' => 'dark',
                                            'no_show' => 'danger',
                                            'cancelled' => 'danger',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$o->status] ?? 'secondary' }}">
                                        {{ $o->status }}
                                    </span>
                                </td>
                                <td>{{ $o->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    @if ($o->final_cost)
                                        Rp {{ number_format($o->final_cost, 0, ',', '.') }}
                                    @elseif($o->estimated_cost)
                                        <small>Estimasi: Rp {{ number_format($o->estimated_cost, 0, ',', '.') }}</small>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p>Tidak ada data servis pada periode ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('serviceChart').getContext('2d');
            const labels = {!! json_encode($chart->keys()) !!};
            const data = {!! json_encode($chart->values()) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Servis',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush

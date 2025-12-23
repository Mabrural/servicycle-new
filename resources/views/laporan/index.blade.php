@extends('layouts.main')

@section('container')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">📊 Laporan Bengkel</h4>

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
               href="{{ route('laporan.bengkel.pdf', request()->query()) }}"
               class="btn btn-danger">
                Download PDF
            </a>
        </div>
    </form>

    {{-- Statistik --}}
    <div class="row mb-4">
        @foreach ($stats as $label => $value)
        <div class="col-md-2">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">{{ ucfirst(str_replace('_',' ', $label)) }}</h6>
                    <h3 class="fw-bold">{{ $value }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Grafik --}}
    <div class="card mb-4">
        <div class="card-body">
            <canvas id="serviceChart"></canvas>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $o->customer_name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ $o->status }}</span>
                        </td>
                        <td>{{ $o->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
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
new Chart(document.getElementById('serviceChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart->keys()) !!},
        datasets: [{
            label: 'Jumlah Servis',
            data: {!! json_encode($chart->values()) !!}
        }]
    }
});
</script>
@endpush

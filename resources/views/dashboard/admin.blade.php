<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div>
        <h4 class="card-title mb-0">Dashboard Admin</h4>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
    {{-- <div>
        <div class="btn-wrapper">
            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Export Report</a>
            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-printer"></i> Print</a>
        </div>
    </div> --}}
</div>

<div class="row mt-4">
    <!-- Statistik Utama -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-primary">
                            <i class="mdi mdi-account-group text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Mitra</p>
                        <h4>{{ $data['totalMitra'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-check-circle text-success me-1"></i>
                    {{ $data['activeMitra'] ?? 0 }} Aktif
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-info">
                            <i class="mdi mdi-account text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Customer</p>
                        <h4>{{ $data['totalCustomer'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-arrow-up text-success me-1"></i>
                    {{ $data['newUsersThisMonth'] ?? 0 }} baru bulan ini
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-success">
                            <i class="mdi mdi-cart text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Order</p>
                        <h4>{{ $data['totalOrders'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-calendar text-primary me-1"></i>
                    {{ $data['newMitraThisMonth'] ?? 0 }} mitra baru
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-warning">
                            <i class="mdi mdi-cash text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Pendapatan</p>
                        <h4>Rp {{ number_format($data['totalRevenue'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-calendar-check text-info me-1"></i>
                    Rp {{ number_format($data['monthlyRevenue'] ?? 0, 0, ',', '.') }} bulan ini
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Chart Order 30 Hari Terakhir -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order 30 Hari Terakhir</h4>
                <canvas id="ordersChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Order -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Status Order</h4>
                <div id="ordersStatusChart"></div>
                <div class="mt-3">
                    @foreach ($data['ordersByStatus'] ?? [] as $status)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $status->status }}</span>
                            <span class="badge bg-primary">{{ $status->total }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Top Mitra -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Top 5 Mitra</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Bengkel</th>
                                <th>Total Order</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['topMitras'] ?? [] as $index => $mitra)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mitra->business_name }}</td>
                                    <td>{{ $mitra->total_orders }}</td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td>{{ $mitra->regency ?? '-' }}</td>
                                </tr>
                            @endforeach
                            @if (empty($data['topMitras']))
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Chart untuk order 30 hari terakhir
        const ordersChartCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersChartCtx, {
            type: 'line',
            data: {
                labels: @json($data['last30DaysOrders']->pluck('date') ?? []),
                datasets: [{
                    label: 'Jumlah Order',
                    data: @json($data['last30DaysOrders']->pluck('total') ?? []),
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>
@endpush

<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div>
        <h4 class="card-title mb-0">Dashboard Mitra</h4>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }} - {{ $mitra->business_name ?? 'Bengkel Anda' }}</p>
    </div>
    <div>
        <div class="btn-wrapper">
            <a href="{{ route('service-orders.index') }}" class="btn btn-primary text-white me-2">
                <i class="mdi mdi-cart-plus"></i> Kelola Order
            </a>
            <a href="{{ route('profile.mitra') }}" class="btn btn-outline-primary">
                <i class="mdi mdi-cog"></i> Pengaturan
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Statistik Utama -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-primary">
                            <i class="mdi mdi-cart text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Order</p>
                        <h4>{{ $data['totalOrders'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-calendar text-info me-1"></i>
                    {{ $data['todayOrders'] ?? 0 }} hari ini
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-info">
                            <i class="mdi mdi-clock text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Order Pending</p>
                        <h4>{{ $data['pendingOrders'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-check-circle text-success me-1"></i>
                    {{ $data['completedOrders'] ?? 0 }} selesai bulan ini
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-success">
                            <i class="mdi mdi-cash text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Pendapatan</p>
                        <h4>Rp {{ number_format($data['monthlyRevenue'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-arrow-up text-success me-1"></i>
                    Bulan {{ now()->format('F') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-warning">
                            <i class="mdi mdi-account-group text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Rating</p>
                        <h4>4.8 <small>/5</small></h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-star text-warning me-1"></i>
                    Berdasarkan review
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Antrian Hari Ini -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Antrian Hari Ini</h4>
                    <span class="badge bg-primary">{{ $data['todayQueue']->count() ?? 0 }} Antrian</span>
                </div>
                
                @if($data['todayQueue'] && $data['todayQueue']->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No Antrian</th>
                                <th>Customer</th>
                                <th>Kendaraan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['todayQueue'] as $order)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">#{{ $order->queue_number }}</span>
                                </td>
                                <td>{{ $order->customer_name ?? 'Walk-in' }}</td>
                                <td>{{ $order->vehicle_brand_manual ?? '-' }} {{ $order->vehicle_model_manual ?? '-' }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'waiting' => 'warning',
                                            'in_progress' => 'info',
                                            'done' => 'success'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="mdi mdi-cart-off display-4 text-muted"></i>
                    <p class="mt-2">Tidak ada antrian hari ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart Order 7 Hari Terakhir -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order 7 Hari Terakhir</h4>
                <canvas id="mitraOrdersChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Order Terbaru -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Order Terbaru</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Jenis</th>
                                <th>Keluhan</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentOrders = \App\Models\ServiceOrder::where('mitra_id', $mitra->id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ substr($order->uuid, 0, 8) }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->customer_name ?? 'Walk-in' }}</td>
                                <td>{{ $order->order_type == 'online' ? 'Online' : 'Walk-in' }}</td>
                                <td>{{ Str::limit($order->customer_complain, 30) ?? '-' }}</td>
                                <td>
                                    @if($order->final_cost)
                                        Rp {{ number_format($order->final_cost, 0, ',', '.') }}
                                    @elseif($order->estimated_cost)
                                        <span class="text-muted">Rp {{ number_format($order->estimated_cost, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->status_color }} text-dark">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($recentOrders->count() == 0)
                            <tr>
                                <td colspan="7" class="text-center">Belum ada order</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('service-orders.index') }}" class="btn btn-primary text-white">Lihat Semua Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Chart untuk order mitra
    const mitraOrdersChartCtx = document.getElementById('mitraOrdersChart').getContext('2d');
    const mitraOrdersChart = new Chart(mitraOrdersChartCtx, {
        type: 'bar',
        data: {
            labels: @json($data['last7DaysOrders']->pluck('date') ?? []),
            datasets: [{
                label: 'Jumlah Order',
                data: @json($data['last7DaysOrders']->pluck('total') ?? []),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
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
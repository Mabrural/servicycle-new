<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <div>
        <h4 class="card-title mb-0">Dashboard Customer</h4>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
    <div>
        <div class="btn-wrapper">
            <a href="/" class="btn btn-primary text-white me-2">
                <i class="mdi mdi-plus-circle"></i> Buat Booking Baru
            </a>
            <a href="{{ route('vehicle.index') }}" class="btn btn-outline-primary">
                <i class="mdi mdi-car"></i> Kendaraan Saya
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Statistik Utama -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="icon-box bg-primary">
                            <i class="mdi mdi-car text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Kendaraan</p>
                        <h4>{{ $data['totalVehicles'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-information text-info me-1"></i>
                    Terdaftar
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
                            <i class="mdi mdi-cart text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Total Order</p>
                        <h4>{{ $data['totalOrders'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-clock text-warning me-1"></i>
                    {{ $data['activeOrders'] ?? 0 }} aktif
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
                            <i class="mdi mdi-check-circle text-white"></i>
                        </div>
                    </div>
                    <div class="float-end text-end">
                        <p class="card-text text-dark">Order Selesai</p>
                        <h4>{{ $data['completedOrders'] ?? 0 }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-history text-success me-1"></i>
                    Riwayat servis
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
                        <p class="card-text text-dark">Total Pengeluaran</p>
                        <h4>Rp {{ number_format($data['totalSpent'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <p class="text-muted mb-0">
                    <i class="mdi mdi-currency-usd text-warning me-1"></i>
                    Untuk servis kendaraan
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Order Terbaru -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Order Terbaru</h4>

                @if ($data['recentOrders'] && $data['recentOrders']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Bengkel</th>
                                    <th>Kendaraan</th>
                                    <th>Keluhan</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['recentOrders'] as $order)
                                    <tr>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $order->mitra->business_name ?? '-' }}</td>
                                        <td>
                                            @if ($order->vehicle)
                                                {{ $order->vehicle->brand }} {{ $order->vehicle->model }}
                                            @else
                                                {{ $order->vehicle_brand_manual }} {{ $order->vehicle_model_manual }}
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($order->customer_complain, 20) ?? '-' }}</td>
                                        <td>
                                            @if ($order->final_cost)
                                                Rp {{ number_format($order->final_cost, 0, ',', '.') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $order->status_color }} text-dark">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('booking.track', $order->uuid) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="mdi mdi-cart-off display-4 text-muted"></i>
                        <p class="mt-2">Belum ada order servis</p>
                        <a href="/" class="btn btn-primary text-white me-2">
                             Buat Booking Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kendaraan Saya -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Kendaraan Saya</h4>
                    <a href="{{ route('vehicle.index') }}" class="btn btn-sm btn-primary text-white">Lihat Semua</a>
                </div>

                @if ($data['vehicles'] && $data['vehicles']->count() > 0)
                    <div class="list-group">
                        @foreach ($data['vehicles'] as $vehicle)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $vehicle->brand }} {{ $vehicle->model }}</h6>
                                        <small class="text-muted">{{ $vehicle->plate_number }} •
                                            {{ $vehicle->vehicle_type }}</small>
                                    </div>
                                    <span class="badge bg-info">{{ $vehicle->tahun }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="mdi mdi-car-off display-4 text-muted"></i>
                        <p class="mt-2">Belum ada kendaraan</p>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-sm btn-primary text-white">
                            Tambah Kendaraan
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Order -->
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title mb-3">Status Order</h4>
                @foreach ($data['ordersByStatus'] ?? [] as $status)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>{{ $status->status_text ?? $status->status }}</span>
                        <span class="badge bg-secondary">{{ $status->total }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Rekomendasi Bengkel Terdekat -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    Rekomendasi Bengkel Terdekat
                    <small class="text-muted">(berdasarkan lokasi Anda)</small>
                </h4>

                <div class="row" id="recommendedMitras">
                    <div class="col-12 text-center py-4 text-muted">
                        <i class="mdi mdi-map-marker-radius mdi-36px"></i>
                        <p>Mendeteksi lokasi Anda...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $mitras = \App\Models\Mitra::where('is_active', true)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get(['id', 'business_name', 'slug', 'regency', 'latitude', 'longitude']);
@endphp

<script>
    const mitras = @json($mitras);

    function toRad(value) {
        return value * Math.PI / 180;
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // KM
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) *
            Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function renderMitras(sortedMitras) {
        const container = document.getElementById('recommendedMitras');
        container.innerHTML = '';

        if (sortedMitras.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center py-4 text-muted">
                    Tidak ada bengkel terdekat
                </div>`;
            return;
        }

        sortedMitras.slice(0, 3).forEach(mitra => {
            container.innerHTML += `
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border h-100">
                        <div class="card-body">
                            <h5 class="card-title">${mitra.business_name}</h5>
                            <p class="text-muted mb-1">
                                <i class="mdi mdi-map-marker"></i> ${mitra.regency}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="mdi mdi-ruler"></i>
                                ${mitra.distance.toFixed(2)} km dari Anda
                            </p>
                            <a href="/bengkel/${mitra.slug}"
                               class="btn btn-sm btn-primary text-white">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            const mitrasWithDistance = mitras.map(mitra => ({
                ...mitra,
                distance: calculateDistance(
                    userLat,
                    userLng,
                    mitra.latitude,
                    mitra.longitude
                )
            }));

            mitrasWithDistance.sort((a, b) => a.distance - b.distance);

            renderMitras(mitrasWithDistance);
        }, error => {
            document.getElementById('recommendedMitras').innerHTML = `
                <div class="col-12 text-center py-4 text-danger">
                    Gagal mendapatkan lokasi Anda
                </div>`;
        });
    } else {
        document.getElementById('recommendedMitras').innerHTML = `
            <div class="col-12 text-center py-4 text-danger">
                Browser tidak mendukung geolocation
            </div>`;
    }
</script>

<div class="card">
    <div class="card-body">

        <h4>Bukti Servis</h4>
        <hr>

        <p><strong>No Servis:</strong> {{ $order->uuid }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>

        <hr>

        <h5>Data Pelanggan</h5>
        <p>Nama: {{ $order->customer_name }}</p>
        <p>Telepon: {{ $order->customer_phone }}</p>

        <h5 class="mt-3">Kendaraan</h5>
        <p>Plat: {{ $order->vehicle_plate_manual }}</p>

        <h5 class="mt-3">Keluhan</h5>
        <p>{{ $order->customer_complain }}</p>

        <h5>Diagnosa</h5>
        <p>{{ $order->diagnosed_problem }}</p>

        <h5>Biaya</h5>
        <p>Estimasi: Rp {{ number_format($order->estimated_cost) }}</p>
        <p><strong>Final: Rp {{ number_format($order->final_cost) }}</strong></p>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('service-orders.download', $order->id) }}"
               class="btn btn-primary">
                Download PDF
            </a>

            <a href="{{ route('service-orders.index') }}"
               class="btn btn-light">
                Kembali
            </a>
        </div>

    </div>
</div>

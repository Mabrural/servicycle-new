<h3>Bukti Servis Bengkel</h3>
<hr>

<p>No Servis: {{ $order->uuid }}</p>
<p>Tanggal: {{ $order->created_at }}</p>

<hr>

<p>Pelanggan: {{ $order->customer_name }}</p>
<p>Kendaraan: {{ $order->vehicle_plate_manual }}</p>

<hr>

<p>Keluhan: {{ $order->customer_complain }}</p>
<p>Diagnosa: {{ $order->diagnosed_problem }}</p>

<hr>

<p>Estimasi: Rp {{ number_format($order->estimated_cost) }}</p>
<p><strong>Final: Rp {{ number_format($order->final_cost) }}</strong></p>

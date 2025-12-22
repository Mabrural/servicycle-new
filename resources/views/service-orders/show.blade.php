<h4>Detail Servis</h4>

<table class="table table-bordered">
    <tr>
        <th>Pelanggan</th>
        <td>{{ $order->customer_name }}</td>
    </tr>
    <tr>
        <th>No HP</th>
        <td>{{ $order->customer_phone }}</td>
    </tr>
    <tr>
        <th>Kendaraan</th>
        <td>{{ $order->vehicle_plate_manual }}</td>
    </tr>
    <tr>
        <th>Keluhan</th>
        <td>{{ $order->customer_complain }}</td>
    </tr>
    <tr>
        <th>Diagnosa</th>
        <td>{{ $order->diagnosed_problem }}</td>
    </tr>
    <tr>
        <th>Biaya</th>
        <td>Rp {{ number_format($order->final_cost) }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
    </tr>
</table>

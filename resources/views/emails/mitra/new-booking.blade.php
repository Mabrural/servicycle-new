<!DOCTYPE html>
<html>

<body>
    <h2>🔔 Booking Online Baru</h2>

    <p>
        Halo <strong>{{ $order->mitra->business_name }}</strong>,
    </p>

    <p>Ada booking servis online baru dengan detail:</p>

    <table cellpadding="6">
        <tr>
            <td><strong>Nama Pelanggan</strong></td>
            <td>{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <td><strong>No HP</strong></td>
            <td>{{ $order->customer_phone }}</td>
        </tr>
        <tr>
            <td><strong>Keluhan</strong></td>
            <td>{{ $order->customer_complain }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>{{ strtoupper($order->status) }}</td>
        </tr>
    </table>

    <p>
        Silakan login ke dashboard untuk menerima atau menolak booking.
    </p>

    <p>
        — {{ config('app.name') }}
    </p>
</body>

</html>

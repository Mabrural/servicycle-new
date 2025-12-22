<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>

<body>

    <h3 style="text-align:center">BUKTI SERVIS KENDARAAN</h3>

    <table>
        <tr>
            <th>No Antrian</th>
            <td>{{ $order->queue_number }}</td>
        </tr>
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
            <th>Total Biaya</th>
            <td>Rp {{ number_format($order->final_cost) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ strtoupper($order->status) }}</td>
        </tr>
    </table>

    <p style="margin-top:30px">
        Dicetak pada: {{ now()->format('d M Y H:i') }}
    </p>

</body>

</html>

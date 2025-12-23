<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>

<h2>Laporan Bengkel</h2>
<p>Periode: {{ $start }} s/d {{ $end }}</p>

<p>
    Total Servis: {{ $stats['total'] }} <br>
    Selesai: {{ $stats['done'] }} <br>
    Cancelled: {{ $stats['cancelled'] }} <br>
    No Show: {{ $stats['no_show'] }}
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $o)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $o->customer_name ?? '-' }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Bengkel - {{ $mitra->business_name ?? 'Bengkel' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .stats {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .stats h4 {
            margin-top: 0;
            color: #333;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #666;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .badge-secondary {
            background-color: #e2e3e5;
            color: #383d41;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN BENGKEL</h2>
        <h3>{{ $mitra->business_name ?? '-' }}</h3>
        <p>{{ $mitra->address ?? '-' }}</p>
        <p>Periode: {{ \Carbon\Carbon::parse($start)->format('d M Y') }} s/d
            {{ \Carbon\Carbon::parse($end)->format('d M Y') }}</p>
        <p>Dibuat pada: {{ now()->format('d M Y H:i') }}</p>
    </div>

    <div class="stats">
        <h4>📊 Statistik Servis</h4>
        <p>
            <strong>Total Servis:</strong> {{ $stats['total'] }} |
            <strong>Selesai:</strong> {{ $stats['done'] }} |
            <strong>Dalam Proses:</strong> {{ $stats['in_progress'] + $stats['waiting'] }} |
            <strong>Pending:</strong> {{ $stats['pending'] }} |
            <strong>Dibatalkan:</strong> {{ $stats['cancelled'] + $stats['rejected'] }} |
            <strong>No Show:</strong> {{ $stats['no_show'] }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Customer</th>
                <th width="15%">No. HP</th>
                <th width="20%">Kendaraan</th>
                <th width="15%">Status</th>
                <th width="15%">Tanggal</th>
                <th width="10%" class="text-right">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $o->customer_name ?? '-' }}</td>
                    <td>{{ $o->customer_phone ?? '-' }}</td>
                    <td>
                        @if ($o->vehicle_brand_manual)
                            {{ $o->vehicle_brand_manual }} {{ $o->vehicle_model_manual }}
                        @elseif($o->vehicle)
                            {{ $o->vehicle->brand }} {{ $o->vehicle->model }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $statusColors = [
                                'done' => 'success',
                                'in_progress' => 'info',
                                'waiting' => 'warning',
                                'pending' => 'secondary',
                                'cancelled' => 'danger',
                                'rejected' => 'danger',
                                'no_show' => 'danger',
                            ];
                            $color = $statusColors[$o->status] ?? 'secondary';
                        @endphp
                        <span class="badge badge-{{ $color }}">{{ $o->status }}</span>
                    </td>
                    <td>{{ $o->created_at->format('d M Y H:i') }}</td>
                    <td class="text-right">
                        @if ($o->final_cost)
                            Rp {{ number_format($o->final_cost, 0, ',', '.') }}
                        @elseif($o->estimated_cost)
                            <small>Rp {{ number_format($o->estimated_cost, 0, ',', '.') }}</small>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($orders->isEmpty())
        <div style="text-align: center; padding: 30px; color: #666;">
            <p>Tidak ada data servis pada periode ini</p>
        </div>
    @endif

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Servicycle</p>
    </div>

</body>

</html>

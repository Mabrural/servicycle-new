<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Bengkel - {{ $mitra->business_name ?? 'Bengkel' }}</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        /* ================= HEADER ================= */
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header-table {
            width: 100%;
        }

        .header-left {
            width: 70%;
        }

        .header-right {
            width: 30%;
            text-align: right;
            font-size: 10px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 12px;
            margin-top: 4px;
        }

        /* ================= SUMMARY ================= */
        .summary {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #000;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-size: 12px;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 4px 6px;
            border-bottom: 1px dashed #ccc;
        }

        /* ================= TABLE ================= */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        table.data th {
            text-align: center;
            font-weight: bold;
            background: #f5f5f5;
        }

        table.data td {
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* ================= FOOTER ================= */
        .footer {
            margin-top: 20px;
            font-size: 9px;
            text-align: right;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    {{-- ================= HEADER ================= --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="title">LAPORAN OPERASIONAL BENGKEL</div>
                    <div class="subtitle">{{ $mitra->business_name ?? '-' }}</div>
                    <div class="subtitle">{{ $mitra->address ?? '-' }}</div>
                </td>
                <td class="header-right">
                    <div><strong>Periode</strong></div>
                    <div>
                        {{ \Carbon\Carbon::parse($start)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($end)->format('d M Y') }}
                    </div>
                    <div style="margin-top:5px;">
                        Dicetak: {{ now()->format('d M Y H:i') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ================= SUMMARY ================= --}}
    <div class="summary">
        <div class="summary-title">Ringkasan Servis</div>
        <table class="summary-table">
            <tr>
                <td>Total Servis</td>
                <td>: {{ $stats['total'] }}</td>
                <td>Servis Selesai</td>
                <td>: {{ $stats['done'] }}</td>
            </tr>
            <tr>
                <td>Dalam Proses</td>
                <td>: {{ $stats['in_progress'] + $stats['waiting'] }}</td>
                <td>Pending</td>
                <td>: {{ $stats['pending'] }}</td>
            </tr>
            <tr>
                <td>Dibatalkan</td>
                <td>: {{ $stats['cancelled'] + $stats['rejected'] }}</td>
                <td>No Show</td>
                <td>: {{ $stats['no_show'] }}</td>
            </tr>
        </table>
    </div>

    {{-- ================= DATA TABLE ================= --}}
    <table class="data">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="16%">Customer</th>
                <th width="12%">No. HP</th>
                <th width="18%">Kendaraan</th>
                <th width="10%">Status</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $o)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
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
                    <td class="text-center">{{ strtoupper($o->status) }}</td>
                    <td class="text-center">{{ $o->created_at->format('d M Y H:i') }}</td>
                    <td class="text-right">
                        @if ($o->final_cost)
                            Rp {{ number_format($o->final_cost, 0, ',', '.') }}
                        @elseif($o->estimated_cost)
                            Rp {{ number_format($o->estimated_cost, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding:20px;">
                        Tidak ada data servis pada periode ini
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ================= FOOTER ================= --}}
    <div class="footer">
        Laporan ini dihasilkan otomatis oleh sistem <strong>Servicycle</strong> dan sah tanpa tanda tangan.
    </div>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bukti Servis</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }

        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 6px;
            border-left: 4px solid #3498db;
            padding-left: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-detail td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .table-detail td.label {
            width: 30%;
            font-weight: bold;
            color: #555;
        }

        .table-detail td.value {
            width: 70%;
        }

        .divider {
            border-top: 1px dashed #bbb;
            margin: 15px 0;
        }

        .cost-table td {
            padding: 6px;
        }

        .final-cost {
            font-size: 14px;
            font-weight: bold;
            color: #27ae60;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #777;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>{{ $order->mitra->business_name ?? 'Bengkel ServiCycle' }}</h2>
        <p>{{ $order->mitra->address ?? '-' }}</p>
        <p>Telp: {{ $order->mitra->phone ?? '-' }}</p>
    </div>

    {{-- INFO SERVIS --}}
    <div class="section">
        <table class="table-detail">
            <tr>
                <td class="label">No Servis</td>
                <td class="value">: {{ $order->uuid }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal</td>
                <td class="value">: {{ $order->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">: {{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
            </tr>
        </table>
    </div>

    <div class="divider"></div>

    {{-- DATA PELANGGAN --}}
    <div class="section">
        <div class="section-title">Data Pelanggan</div>
        <table class="table-detail">
            <tr>
                <td class="label">Nama</td>
                <td class="value">: {{ $order->customer_name }}</td>
            </tr>
            <tr>
                <td class="label">Telepon</td>
                <td class="value">: {{ $order->customer_phone }}</td>
            </tr>
        </table>
    </div>

    {{-- DATA KENDARAAN --}}
    <div class="section">
        <div class="section-title">Data Kendaraan</div>
        <table class="table-detail">
            <tr>
                <td class="label">Plat Nomor</td>
                <td class="value">: {{ $order->vehicle_plate_manual }}</td>
            </tr>
            <tr>
                <td class="label">Jenis / Model</td>
                <td class="value">
                    : {{ $order->vehicle_type_manual }} {{ $order->vehicle_brand_manual }}
                    {{ $order->vehicle_model_manual }}
                </td>
            </tr>
        </table>
    </div>

    {{-- KELUHAN & DIAGNOSA --}}
    <div class="section">
        <div class="section-title">Keluhan Pelanggan</div>
        <p>{{ $order->customer_complain }}</p>
    </div>

    <div class="section">
        <div class="section-title">Diagnosa Bengkel</div>
        <p>{{ $order->diagnosed_problem }}</p>
    </div>

    <div class="divider"></div>

    {{-- BIAYA --}}
    <div class="section">
        <div class="section-title">Rincian Biaya</div>
        <table class="cost-table">
            <tr>
                <td>Estimasi Biaya</td>
                <td align="right">
                    Rp {{ number_format($order->estimated_cost ?? 0, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td><strong>Total Akhir</strong></td>
                <td align="right" class="final-cost">
                    Rp {{ number_format($order->final_cost ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Bukti servis ini dihasilkan secara otomatis oleh sistem ServiCycle.<br>
        Terima kasih telah mempercayakan kendaraan Anda kepada kami.
    </div>

</body>

</html>

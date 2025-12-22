<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Servis</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 6px;
            vertical-align: top;
        }

        .info-table td.label {
            width: 30%;
            font-weight: bold;
            background: #f7f7f7;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
            background: #fafafa;
        }

        .cost-table th,
        .cost-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }

        .cost-table th {
            background: #f0f0f0;
            text-align: center;
        }

        .cost-table td.label {
            text-align: left;
            font-weight: bold;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
            background: #eaf4ff;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>{{ $order->mitra->business_name ?? 'Bengkel ServiCycle' }}</h2>
        <p>Bukti Servis Kendaraan</p>
        <p>No Servis: {{ $order->uuid }}</p>
        <p>Tanggal: {{ $order->created_at->format('d M Y') }}</p>
    </div>

    {{-- DATA PELANGGAN & KENDARAAN --}}
    <div class="section">
        <div class="section-title">Informasi Pelanggan & Kendaraan</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Pelanggan</td>
                <td>{{ $order->customer_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">No Telepon</td>
                <td>{{ $order->customer_phone ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Plat Kendaraan</td>
                <td>{{ $order->vehicle_plate_manual ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- KELUHAN --}}
    <div class="section">
        <div class="section-title">Keluhan Pelanggan</div>
        <div class="box">
            {{ $order->customer_complain ?? '-' }}
        </div>
    </div>

    {{-- DIAGNOSA --}}
    <div class="section">
        <div class="section-title">Diagnosa Bengkel</div>
        <div class="box">
            {{ $order->diagnosed_problem ?? '-' }}
        </div>
    </div>

    {{-- BIAYA --}}
    <div class="section">
        <div class="section-title">Rincian Biaya</div>
        <table class="cost-table">
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td class="label">Estimasi Biaya</td>
                <td>Rp {{ number_format($order->estimated_cost ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td class="label">Total Akhir</td>
                <td>Rp {{ number_format($order->final_cost ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <p>Terima kasih telah mempercayakan servis kendaraan Anda kepada kami.</p>
        <p>Dokumen ini dihasilkan secara otomatis oleh sistem.</p>
    </div>

</body>

</html>

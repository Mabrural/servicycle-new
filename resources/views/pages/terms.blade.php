@extends('layouts.static')

@section('title', 'Ketentuan Layanan')

@section('content')
    <h1>Ketentuan Layanan</h1>
    <div class="updated">Terakhir diperbarui: {{ now()->format('d F Y') }}</div>

    <h2>1. Deskripsi Layanan</h2>
    <p>
        ServiCycle adalah platform digital manajemen servis kendaraan
        dengan fitur tambahan berbasis langganan Pro.
    </p>

    <h2>2. Akun Pengguna</h2>
    <ul>
        <li>Pengguna wajib memberikan informasi yang benar</li>
        <li>Pengguna bertanggung jawab atas keamanan akun</li>
    </ul>

    <h2>3. Langganan & Pembayaran</h2>
    <p>
        Pembayaran langganan diproses melalui mitra pembayaran resmi seperti TriPay.
        ServiCycle tidak menyimpan data pembayaran sensitif.
    </p>

    <h2>4. Larangan</h2>
    <ul>
        <li>Penyalahgunaan sistem</li>
        <li>Akses ilegal</li>
        <li>Aktivitas yang melanggar hukum</li>
    </ul>

    <h2>5. Pembatasan Tanggung Jawab</h2>
    <p>
        ServiCycle tidak bertanggung jawab atas kerugian akibat penggunaan layanan
        di luar ketentuan atau gangguan teknis di luar kendali kami.
    </p>

    <h2>6. Hukum yang Berlaku</h2>
    <p>
        Ketentuan ini tunduk pada hukum Republik Indonesia.
    </p>
@endsection

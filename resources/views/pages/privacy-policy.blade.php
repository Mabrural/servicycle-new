@extends('layouts.static')

@section('title', 'Kebijakan Privasi')

@section('content')
    <h1>Kebijakan Privasi</h1>
    <div class="updated">Terakhir diperbarui: {{ now()->format('d F Y') }}</div>

    <p>
        ServiCycle menghargai dan melindungi privasi pengguna. Kebijakan ini menjelaskan
        bagaimana kami mengelola data pribadi pengguna.
    </p>

    <h2>1. Informasi yang Dikumpulkan</h2>
    <ul>
        <li>Nama, email, dan nomor telepon</li>
        <li>Informasi akun pengguna</li>
        <li>Data transaksi langganan (tanpa menyimpan data pembayaran sensitif)</li>
        <li>Data teknis seperti alamat IP dan aktivitas penggunaan</li>
    </ul>

    <h2>2. Penggunaan Informasi</h2>
    <p>
        Data digunakan untuk menyediakan layanan, memproses langganan, meningkatkan sistem,
        serta menjaga keamanan platform.
    </p>

    <h2>3. Keamanan Data</h2>
    <p>
        Kami menerapkan langkah keamanan teknis dan administratif untuk melindungi data pengguna.
    </p>

    <h2>4. Pembagian Informasi</h2>
    <p>
        ServiCycle tidak menjual data pengguna. Informasi hanya dibagikan kepada mitra resmi
        seperti penyedia pembayaran untuk keperluan operasional.
    </p>

    <h2>5. Hak Pengguna</h2>
    <ul>
        <li>Mengakses dan memperbarui data</li>
        <li>Meminta penghapusan akun</li>
        <li>Menarik persetujuan penggunaan data</li>
    </ul>
@endsection

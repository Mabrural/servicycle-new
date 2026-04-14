@extends('layouts.static')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="privacy-container">
    {{-- Navigasi Kembali ke Beranda --}}
    <div class="mb-4">
        <a href="{{ url('/') }}" class="back-link">
            ← Kembali ke Beranda
        </a>
    </div>

    {{-- Header Utama --}}
    <div class="privacy-header">
        <h1>Kebijakan Privasi</h1>
        <p class="last-updated">Terakhir diperbarui: {{ now()->format('d F Y') }}</p>
        <p class="intro">
            Di <strong>ServiCycle</strong>, privasi Anda adalah prioritas utama. 
            Kebijakan ini menjelaskan secara transparan bagaimana kami mengelola, 
            melindungi, dan menggunakan data pribadi Anda.
        </p>
    </div>

    {{-- Daftar Isi (untuk navigasi cepat) --}}
    <div class="toc">
        <h3>Ringkasan Kebijakan</h3>
        <ul>
            <li><a href="#info">1. Informasi yang Dikumpulkan</a></li>
            <li><a href="#penggunaan">2. Penggunaan Informasi</a></li>
            <li><a href="#keamanan">3. Keamanan Data</a></li>
            <li><a href="#pembagian">4. Pembagian Informasi</a></li>
            <li><a href="#hak">5. Hak Pengguna</a></li>
        </ul>
    </div>

    {{-- Bagian 1 --}}
    <div class="privacy-section" id="info">
        <h2>1. Informasi yang Dikumpulkan</h2>
        <div class="card-grid">
            <div class="info-card">
                <div class="icon">👤</div>
                <h4>Identitas Diri</h4>
                <p>Nama lengkap, alamat email, dan nomor telepon.</p>
            </div>
            <div class="info-card">
                <div class="icon">🔐</div>
                <h4>Akun Pengguna</h4>
                <p>Detail akun, preferensi layanan, dan riwayat aktivitas.</p>
            </div>
            <div class="info-card">
                <div class="icon">💳</div>
                <h4>Transaksi Langganan</h4>
                <p>Data transaksi (kami <strong>tidak menyimpan</strong> informasi pembayaran sensitif seperti nomor kartu kredit).</p>
            </div>
            <div class="info-card">
                <div class="icon">🌐</div>
                <h4>Data Teknis</h4>
                <p>Alamat IP, jenis peramban, dan aktivitas penggunaan platform.</p>
            </div>
        </div>
    </div>

    {{-- Bagian 2 --}}
    <div class="privacy-section" id="penggunaan">
        <h2>2. Penggunaan Informasi</h2>
        <div class="usage-list">
            <div class="usage-item">
                <span class="check">✓</span>
                <span>Menyediakan dan mempersonalisasi layanan ServiCycle</span>
            </div>
            <div class="usage-item">
                <span class="check">✓</span>
                <span>Memproses langganan dan pembayaran dengan aman</span>
            </div>
            <div class="usage-item">
                <span class="check">✓</span>
                <span>Meningkatkan sistem, keamanan, dan pengalaman pengguna</span>
            </div>
            <div class="usage-item">
                <span class="check">✓</span>
                <span>Mengirimkan notifikasi penting terkait akun atau layanan</span>
            </div>
        </div>
    </div>

    {{-- Bagian 3 & 4 --}}
    <div class="two-columns">
        <div class="privacy-section" id="keamanan">
            <h2>3. Keamanan Data</h2>
            <p>Kami menerapkan langkah-langkah keamanan <strong>teknis dan administratif</strong> terkini, termasuk enkripsi data, akses terbatas, serta pemantauan rutin untuk melindungi informasi Anda dari akses tidak sah.</p>
            <div class="badge">🔒 100% Data Terenkripsi</div>
        </div>

        <div class="privacy-section" id="pembagian">
            <h2>4. Pembagian Informasi</h2>
            <p><strong>ServiCycle tidak pernah menjual data pribadi Anda.</strong> Informasi hanya dapat dibagikan dengan mitra resmi (misalnya penyedia pembayaran) semata-mata untuk keperluan operasional dan tetap dalam pengawasan ketat.</p>
            <div class="badge warning">🤝 Tidak Dijual ke Pihak Ketiga</div>
        </div>
    </div>

    {{-- Bagian 5 --}}
    <div class="privacy-section" id="hak">
        <h2>5. Hak Pengguna</h2>
        <p>Anda memiliki kendali penuh atas data pribadi Anda. Kapan saja, Anda berhak untuk:</p>
        <ul class="rights-list">
            <li><strong>Mengakses</strong> dan <strong>memperbarui</strong> data Anda melalui pengaturan akun.</li>
            <li><strong>Meminta penghapusan akun</strong> beserta seluruh data yang terkait.</li>
            <li><strong>Menarik persetujuan</strong> penggunaan data untuk pemrosesan tertentu.</li>
        </ul>
        <p class="contact">Untuk menggunakan hak-hak tersebut, hubungi kami di <a href="mailto:support@servicycle.com">support@servicycle.com</a>.</p>
    </div>

    {{-- Footer kebijakan --}}
    <div class="privacy-footer">
        <p>Dengan menggunakan ServiCycle, Anda menyetujui Kebijakan Privasi ini.</p>
        <a href="{{ url('/') }}" class="btn-home">🏠 Kembali ke Beranda</a>
    </div>
</div>

{{-- CSS Internal / Bisa dipindah ke file CSS terpisah --}}
<style>
    .privacy-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        line-height: 1.5;
        color: #1e293b;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    .privacy-header {
        text-align: center;
        margin: 2rem 0 3rem;
    }

    .privacy-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e293b, #3b82f6);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
    }

    .last-updated {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .intro {
        max-width: 800px;
        margin: 0 auto;
        font-size: 1.1rem;
        color: #334155;
    }

    .toc {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1rem 2rem;
        margin-bottom: 2.5rem;
    }

    .toc h3 {
        font-size: 1.1rem;
        margin-top: 0;
        margin-bottom: 0.75rem;
    }

    .toc ul {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .toc li a {
        color: #3b82f6;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .toc li a:hover {
        text-decoration: underline;
    }

    .privacy-section {
        margin-bottom: 2.5rem;
    }

    .privacy-section h2 {
        font-size: 1.75rem;
        font-weight: 600;
        border-left: 5px solid #3b82f6;
        padding-left: 1rem;
        margin-bottom: 1.5rem;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    .info-card .icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }

    .info-card h4 {
        margin: 0 0 0.5rem;
        font-size: 1.1rem;
    }

    .usage-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .usage-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
    }

    .check {
        background: #22c55e20;
        color: #16a34a;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .badge {
        display: inline-block;
        background: #e0f2fe;
        color: #0284c7;
        padding: 0.3rem 0.8rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 1rem;
    }

    .badge.warning {
        background: #fef9c3;
        color: #854d0e;
    }

    .rights-list {
        padding-left: 1.5rem;
        margin: 1rem 0;
    }

    .rights-list li {
        margin: 0.5rem 0;
    }

    .contact {
        background: #f1f5f9;
        padding: 1rem;
        border-radius: 0.75rem;
        margin-top: 1rem;
    }

    .privacy-footer {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .btn-home {
        display: inline-block;
        background: #1e293b;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: 500;
        margin-top: 1rem;
        transition: background 0.2s;
    }

    .btn-home:hover {
        background: #0f172a;
    }

    @media (max-width: 768px) {
        .two-columns {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .privacy-header h1 {
            font-size: 2rem;
        }
        .card-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
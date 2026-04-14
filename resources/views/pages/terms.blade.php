@extends('layouts.static')

@section('title', 'Ketentuan Layanan')

@section('content')
<div class="terms-container">
    {{-- Navigasi Kembali ke Beranda --}}
    <div class="mb-4">
        <a href="{{ url('/') }}" class="back-link">
            ← Kembali ke Beranda
        </a>
    </div>

    {{-- Header Utama --}}
    <div class="terms-header">
        <h1>Ketentuan Layanan</h1>
        <p class="last-updated">Terakhir diperbarui: {{ now()->format('d F Y') }}</p>
        <p class="intro">
            Selamat datang di <strong>ServiCycle</strong>. Dengan mengakses atau menggunakan layanan kami, 
            Anda menyetujui untuk terikat oleh Ketentuan Layanan ini. Harap baca dengan saksama.
        </p>
    </div>

    {{-- Daftar Isi (untuk navigasi cepat) --}}
    <div class="toc">
        <h3>Ringkasan Ketentuan</h3>
        <ul>
            <li><a href="#deskripsi">1. Deskripsi Layanan</a></li>
            <li><a href="#akun">2. Akun Pengguna</a></li>
            <li><a href="#langganan">3. Langganan & Pembayaran</a></li>
            <li><a href="#larangan">4. Larangan</a></li>
            <li><a href="#tanggung-jawab">5. Pembatasan Tanggung Jawab</a></li>
            <li><a href="#hukum">6. Hukum yang Berlaku</a></li>
        </ul>
    </div>

    {{-- Bagian 1: Deskripsi Layanan --}}
    <div class="terms-section" id="deskripsi">
        <h2>1. Deskripsi Layanan</h2>
        <div class="service-highlight">
            <div class="service-icon">🔧</div>
            <div class="service-content">
                <p><strong>ServiCycle</strong> adalah platform digital manajemen servis kendaraan yang dirancang untuk memudahkan Anda dalam:</p>
                <ul>
                    <li>Menjadwalkan dan mengelola servis kendaraan</li>
                    <li>Menyimpan riwayat perawatan kendaraan</li>
                    <li>Mengakses fitur tambahan <strong>berbasis langganan Pro</strong></li>
                    <li>Mendapatkan rekomendasi bengkel terpercaya</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bagian 2: Akun Pengguna --}}
    <div class="terms-section" id="akun">
        <h2>2. Akun Pengguna</h2>
        <div class="card-grid">
            <div class="info-card">
                <div class="icon">✅</div>
                <h4>Informasi yang Benar</h4>
                <p>Pengguna wajib memberikan informasi yang akurat, lengkap, dan terkini saat mendaftar.</p>
            </div>
            <div class="info-card">
                <div class="icon">🔒</div>
                <h4>Keamanan Akun</h4>
                <p>Anda bertanggung jawab penuh atas kerahasiaan kata sandi dan semua aktivitas yang terjadi di akun Anda.</p>
            </div>
            <div class="info-card">
                <div class="icon">⚠️</div>
                <h4>Pemberitahuan Pelanggaran</h4>
                <p>Segera hubungi kami jika menemukan akses tidak sah atau pelanggaran keamanan pada akun Anda.</p>
            </div>
        </div>
    </div>

    {{-- Bagian 3: Langganan & Pembayaran --}}
    <div class="terms-section" id="langganan">
        <h2>3. Langganan & Pembayaran</h2>
        <div class="payment-info">
            <div class="payment-card">
                <div class="payment-icon">💳</div>
                <div class="payment-details">
                    <h4>Metode Pembayaran</h4>
                    <p>Pembayaran langganan diproses melalui mitra pembayaran resmi seperti <strong>TriPay</strong> dan penyedia pembayaran terpercaya lainnya.</p>
                </div>
            </div>
            <div class="payment-card">
                <div class="payment-icon">🔐</div>
                <div class="payment-details">
                    <h4>Keamanan Data Pembayaran</h4>
                    <p><strong>ServiCycle tidak menyimpan data pembayaran sensitif</strong> (nomor kartu kredit, CVV, dll). Semua transaksi ditangani oleh gateway pembayaran yang telah tersertifikasi PCI-DSS.</p>
                </div>
            </div>
            <div class="payment-card">
                <div class="payment-icon">🔄</div>
                <div class="payment-details">
                    <h4>Pembatalan & Pengembalian Dana</h4>
                    <p>Langganan dapat dibatalkan kapan saja. Kebijakan pengembalian dana mengikuti ketentuan yang berlaku pada paket langganan yang dipilih.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian 4: Larangan --}}
    <div class="terms-section" id="larangan">
        <h2>4. Larangan</h2>
        <div class="prohibitions-grid">
            <div class="prohibition-item">
                <div class="prohibition-icon">🚫</div>
                <h4>Penyalahgunaan Sistem</h4>
                <p>Menggunakan bot, script, atau otomatisasi untuk mengakses layanan secara berlebihan.</p>
            </div>
            <div class="prohibition-item">
                <div class="prohibition-icon">🔓</div>
                <h4>Akses Ilegal</h4>
                <p>Mencoba mendapatkan akses tidak sah ke sistem, server, atau data pengguna lain.</p>
            </div>
            <div class="prohibition-item">
                <div class="prohibition-icon">⚖️</div>
                <h4>Aktivitas Melanggar Hukum</h4>
                <p>Menggunakan layanan untuk aktivitas yang melanggar hukum Indonesia atau internasional.</p>
            </div>
            <div class="prohibition-item">
                <div class="prohibition-icon">📢</div>
                <h4>Konten Berbahaya</h4>
                <p>Menyebarkan malware, spam, atau konten yang merugikan pengguna lain.</p>
            </div>
        </div>
        <div class="warning-banner">
            <span class="warning-icon">⚠️</span>
            <span>Pelanggaran terhadap ketentuan larangan dapat mengakibatkan penonaktifan akun tanpa pemberitahuan sebelumnya.</span>
        </div>
    </div>

    {{-- Bagian 5 & 6 --}}
    <div class="two-columns">
        <div class="terms-section" id="tanggung-jawab">
            <h2>5. Pembatasan Tanggung Jawab</h2>
            <p>ServiCycle tidak bertanggung jawab atas:</p>
            <ul class="liability-list">
                <li>Kerugian akibat penggunaan layanan di luar ketentuan yang berlaku</li>
                <li>Gangguan teknis di luar kendali kami (force majeure, bencana alam, serangan siber)</li>
                <li>Kehilangan data akibat kelalaian pengguna dalam mencadangkan informasi</li>
                <li>Kerusakan tidak langsung atau konsekuensial yang timbul dari penggunaan layanan</li>
            </ul>
            <div class="badge">📋 Layanan diberikan "sebagaimana adanya" (as-is)</div>
        </div>

        <div class="terms-section" id="hukum">
            <h2>6. Hukum yang Berlaku</h2>
            <p>Ketentuan Layanan ini tunduk pada dan diatur oleh <strong>hukum Republik Indonesia</strong>.</p>
            <p>Setiap sengketa yang timbul dari atau terkait dengan ketentuan ini akan diselesaikan melalui pengadilan yang berwenang di wilayah hukum Republik Indonesia.</p>
            <div class="badge warning">🇮🇩 Yurisdiksi: Republik Indonesia</div>
        </div>
    </div>

    {{-- Tambahan: Perubahan Ketentuan --}}
    <div class="terms-section">
        <h2>7. Perubahan Ketentuan</h2>
        <p>
            ServiCycle berhak untuk memperbarui atau mengubah Ketentuan Layanan ini sewaktu-waktu.
            Perubahan akan diumumkan melalui platform atau email terdaftar. Dengan terus menggunakan layanan
            setelah perubahan diberlakukan, Anda dianggap menyetujui ketentuan yang telah diperbarui.
        </p>
    </div>

    {{-- Footer dengan aksi --}}
    <div class="terms-footer">
        <p>Dengan menggunakan ServiCycle, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh Ketentuan Layanan ini.</p>
        <div class="footer-buttons">
            <a href="{{ url('/') }}" class="btn-home">🏠 Kembali ke Beranda</a>
            <a href="{{ url('/register') }}" class="btn-register">📝 Daftar Sekarang</a>
        </div>
    </div>
</div>

{{-- CSS Internal (konsisten dengan halaman Privacy Policy) --}}
<style>
    .terms-container {
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

    .terms-header {
        text-align: center;
        margin: 2rem 0 3rem;
    }

    .terms-header h1 {
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

    .terms-section {
        margin-bottom: 2.5rem;
    }

    .terms-section h2 {
        font-size: 1.75rem;
        font-weight: 600;
        border-left: 5px solid #3b82f6;
        padding-left: 1rem;
        margin-bottom: 1.5rem;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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

    .service-highlight {
        display: flex;
        gap: 1.5rem;
        background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%);
        padding: 1.5rem;
        border-radius: 1rem;
        align-items: flex-start;
    }

    .service-icon {
        font-size: 3rem;
    }

    .service-content p {
        margin-top: 0;
        font-weight: 500;
    }

    .service-content ul {
        margin-bottom: 0;
    }

    .payment-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .payment-card {
        display: flex;
        gap: 1rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.25rem;
        transition: all 0.2s;
    }

    .payment-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .payment-icon {
        font-size: 2rem;
    }

    .payment-details h4 {
        margin: 0 0 0.25rem;
        font-size: 1rem;
    }

    .payment-details p {
        margin: 0;
        color: #475569;
    }

    .prohibitions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .prohibition-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.25rem;
        text-align: center;
        transition: all 0.2s;
    }

    .prohibition-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .prohibition-icon {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .prohibition-item h4 {
        margin: 0.5rem 0;
        font-size: 1rem;
    }

    .prohibition-item p {
        margin: 0;
        font-size: 0.9rem;
        color: #475569;
    }

    .warning-banner {
        background: #fef2e8;
        border-left: 4px solid #f97316;
        padding: 1rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
    }

    .warning-icon {
        font-size: 1.25rem;
    }

    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .liability-list {
        padding-left: 1.25rem;
        margin: 1rem 0;
    }

    .liability-list li {
        margin: 0.5rem 0;
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

    .terms-footer {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .footer-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-home {
        display: inline-block;
        background: #1e293b;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-home:hover {
        background: #0f172a;
    }

    .btn-register {
        display: inline-block;
        background: #3b82f6;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-register:hover {
        background: #2563eb;
    }

    @media (max-width: 768px) {
        .two-columns {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .terms-header h1 {
            font-size: 2rem;
        }
        .card-grid {
            grid-template-columns: 1fr;
        }
        .prohibitions-grid {
            grid-template-columns: 1fr;
        }
        .service-highlight {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .payment-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .footer-buttons {
            flex-direction: column;
            align-items: center;
        }
        .btn-home, .btn-register {
            width: 100%;
            max-width: 250px;
            text-align: center;
        }
    }
</style>
@endsection
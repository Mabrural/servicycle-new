@extends('layouts.static')

@section('title', 'Kontak Support')

@section('content')
<div class="contact-container">
    {{-- Navigasi Kembali ke Beranda --}}
    <div class="mb-4">
        <a href="{{ url('/') }}" class="back-link">
            ← Kembali ke Beranda
        </a>
    </div>

    {{-- Header Utama --}}
    <div class="contact-header">
        <h1>Kontak Support</h1>
        <p class="last-updated">Siap membantu Anda 24/7</p>
        <p class="intro">
            Kami memahami bahwa pertanyaan atau kendala bisa muncul kapan saja. 
            Tim support <strong>ServiCycle</strong> siap membantu Anda dengan sepenuh hati.
        </p>
    </div>

    {{-- Grid Kontak Utama --}}
    <div class="contact-grid">
        {{-- Kartu Email --}}
        <div class="contact-card">
            <div class="contact-icon">✉️</div>
            <h3>Email Support</h3>
            <p class="contact-detail">support@servicycle.id</p>
            <p class="contact-desc">Respons dalam <strong>1x24 jam</strong> kerja</p>
            <a href="mailto:support@servicycle.id" class="contact-btn email-btn">
                Kirim Email →
            </a>
        </div>

        {{-- Kartu WhatsApp --}}
        <div class="contact-card">
            <div class="contact-icon">💬</div>
            <h3>WhatsApp</h3>
            <p class="contact-detail">0821 7819 2938</p>
            <p class="contact-desc">Chat cepat & respons instan</p>
            <a href="https://wa.me/6282178192938" target="_blank" class="contact-btn wa-btn">
                Chat Sekarang →
            </a>
        </div>

        {{-- Kartu Live Chat --}}
        {{-- <div class="contact-card">
            <div class="contact-icon">💬</div>
            <h3>Live Chat</h3>
            <p class="contact-detail">Tersedia 24/7</p>
            <p class="contact-desc">Bantuan langsung dari customer service</p>
            <button class="contact-btn livechat-btn" onclick="alert('Fitur live chat akan segera terhubung')">
                Mulai Chat →
            </button>
        </div> --}}
    </div>

    {{-- Jam Operasional & Info --}}
    <div class="operasional-card">
        <div class="operasional-icon">🕒</div>
        <div class="operasional-content">
            <h3>Jam Operasional Support</h3>
            <div class="hours-grid">
                <div class="hour-item">
                    <span class="day">Senin – Jumat</span>
                    <span class="time">09.00 – 17.00 WIB</span>
                </div>
                <div class="hour-item">
                    <span class="day">Sabtu – Minggu</span>
                    <span class="time">Tutup (respon via email)</span>
                </div>
                <div class="hour-item">
                    <span class="day">WhatsApp</span>
                    <span class="time">Respons lebih cepat di jam kerja</span>
                </div>
            </div>
        </div>
    </div>


    {{-- FAQ Singkat --}}
    <div class="faq-section">
        <h2>Pertanyaan Umum (FAQ)</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">❓</span>
                    <h4>Bagaimana cara reset password?</h4>
                </div>
                <p class="faq-answer">Klik "Lupa Password" di halaman login, masukkan email terdaftar, ikuti instruksi yang dikirim ke email Anda.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">❓</span>
                    <h4>Apakah ada biaya untuk support?</h4>
                </div>
                <p class="faq-answer">Tidak ada biaya sama sekali. Layanan support ServiCycle <strong>100% gratis</strong> untuk semua pengguna.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">❓</span>
                    <h4>Berapa lama respon email?</h4>
                </div>
                <p class="faq-answer">Kami merespon dalam maksimal 1x24 jam pada hari kerja. Untuk akhir pekan, respon diberikan pada Senin pagi.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">❓</span>
                    <h4>Apakah ada nomor telepon yang bisa dihubungi?</h4>
                </div>
                <p class="faq-answer">Saat ini kami melayani melalui Email dan WhatsApp untuk efisiensi dan dokumentasi yang lebih baik.</p>
            </div>
        </div>
    </div>

    {{-- Footer dengan aksi --}}
    <div class="contact-footer">
        <p>Butuh bantuan segera? Jangan ragu untuk menghubungi tim support kami.</p>
        <div class="footer-buttons">
            <a href="{{ url('/') }}" class="btn-home">🏠 Kembali ke Beranda</a>
            <a href="https://wa.me/6282178192938" target="_blank" class="btn-wa">💬 Hubungi WhatsApp</a>
        </div>
    </div>
</div>

{{-- CSS Internal (konsisten dengan halaman sebelumnya) --}}
<style>
    .contact-container {
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

    .contact-header {
        text-align: center;
        margin: 2rem 0 3rem;
    }

    .contact-header h1 {
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

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .contact-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .contact-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    .contact-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
    }

    .contact-card h3 {
        margin: 0 0 0.75rem;
        font-size: 1.3rem;
    }

    .contact-detail {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0.5rem 0;
    }

    .contact-desc {
        font-size: 0.9rem;
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    .contact-btn {
        display: inline-block;
        padding: 0.6rem 1.25rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .email-btn {
        background: #e0f2fe;
        color: #0284c7;
    }

    .email-btn:hover {
        background: #bae6fd;
        transform: translateX(4px);
    }

    .wa-btn {
        background: #dcfce7;
        color: #16a34a;
    }

    .wa-btn:hover {
        background: #bbf7d0;
        transform: translateX(4px);
    }

    .livechat-btn {
        background: #f3e8ff;
        color: #9333ea;
    }

    .livechat-btn:hover {
        background: #e9d5ff;
        transform: translateX(4px);
    }

    .operasional-card {
        background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
        border-radius: 1.5rem;
        padding: 1.5rem 2rem;
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
        margin-bottom: 3rem;
        border: 1px solid #e2e8f0;
    }

    .operasional-icon {
        font-size: 2.5rem;
    }

    .operasional-content h3 {
        margin: 0 0 1rem;
        font-size: 1.2rem;
    }

    .hours-grid {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .hour-item {
        display: flex;
        gap: 1rem;
        font-size: 0.95rem;
    }

    .hour-item .day {
        font-weight: 600;
        min-width: 160px;
        color: #1e293b;
    }

    .hour-item .time {
        color: #475569;
    }

    .form-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .form-section h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1e293b;
    }

    .form-desc {
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        font-weight: 500;
        font-size: 0.9rem;
        color: #334155;
    }

    .required {
        color: #ef4444;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    .submit-btn {
        background: #3b82f6;
        color: white;
        padding: 0.85rem 1.5rem;
        border: none;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 0.5rem;
        align-self: flex-start;
    }

    .submit-btn:hover {
        background: #2563eb;
        transform: translateX(4px);
    }

    .form-note {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 0.5rem;
    }

    .faq-section {
        margin-bottom: 3rem;
    }

    .faq-section h2 {
        font-size: 1.75rem;
        font-weight: 600;
        border-left: 5px solid #3b82f6;
        padding-left: 1rem;
        margin-bottom: 1.5rem;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .faq-item {
        background: #f8fafc;
        border-radius: 1rem;
        padding: 1.25rem;
        transition: all 0.2s;
    }

    .faq-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .faq-question {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .faq-icon {
        font-size: 1.25rem;
    }

    .faq-question h4 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .faq-answer {
        margin: 0;
        font-size: 0.9rem;
        color: #475569;
        padding-left: 2rem;
    }

    .contact-footer {
        text-align: center;
        margin-top: 2rem;
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

    .btn-wa {
        display: inline-block;
        background: #25D366;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-wa:hover {
        background: #128C7E;
    }

    @media (max-width: 768px) {
        .contact-header h1 {
            font-size: 2rem;
        }
        .contact-grid {
            grid-template-columns: 1fr;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
        .operasional-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .hour-item {
            flex-direction: column;
            gap: 0.25rem;
        }
        .hour-item .day {
            min-width: auto;
        }
        .faq-grid {
            grid-template-columns: 1fr;
        }
        .footer-buttons {
            flex-direction: column;
            align-items: center;
        }
        .btn-home, .btn-wa {
            width: 100%;
            max-width: 250px;
            text-align: center;
        }
    }
</style>
@endsection
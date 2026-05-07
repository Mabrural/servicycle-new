@extends('auth.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- Hero Background Section --}}
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="hero-badge">
                            <i class="fas fa-wrench me-1"></i> Bengkel Resmi ServiCycle
                        </div>
                        <h1 class="hero-title">{{ $mitra->business_name }}</h1>
                        {{-- <div class="hero-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.8 (120+ ulasan)</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="main-section">
        <div class="container">

            {{-- ================= HEADER CARD ================= --}}
            <div class="card-modern mb-4">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <div class="cover-wrapper">
                            <img src="{{ $mitra->coverImage
                                ? asset('storage/' . $mitra->coverImage->image_path)
                                : asset('assets/images/no-image.jpg') }}"
                                class="cover-image" alt="{{ $mitra->business_name }}">
                            @if ($mitra->isOpenNow())
                                <div class="open-badge pulse">
                                    <i class="fas fa-circle"></i> Buka Sekarang
                                </div>
                            @else
                                <div class="closed-badge">
                                    <i class="fas fa-circle"></i> Tutup
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card-modern-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="business-name">{{ $mitra->business_name }}</h2>
                                    <div class="business-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $mitra->address }}, {{ $mitra->regency }}, {{ $mitra->province }}
                                    </div>
                                </div>
                                @isset($mitra->distance)
                                    <div class="distance-badge">
                                        <i class="fas fa-location-dot"></i>
                                        {{ number_format($mitra->distance, 1) }} km
                                    </div>
                                @endisset
                            </div>

                            <div class="business-description">
                                <i class="fas fa-quote-left"></i>
                                <p>{{ $mitra->description ?? 'Belum ada deskripsi bengkel.' }}</p>
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('booking.create', $mitra->slug) }}" id="btnBooking"
                                    class="btn-primary-modern {{ !$mitra->isOpenNow() ? 'disabled' : '' }}">
                                    <i class="fas fa-calendar-alt"></i> Booking Servis
                                </a>
                                <a href="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}"
                                    target="_blank" class="btn-outline-modern">
                                    <i class="fas fa-map-marker-alt"></i> Buka di Maps
                                </a>
                                <a href="{{ url()->previous() }}" class="btn-outline-modern">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= CONTENT ================= --}}
            <div class="row g-4">

                {{-- ===== LEFT COLUMN ===== --}}
                <div class="col-lg-8">

                    {{-- SERVICES SECTION --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-tools"></i>
                            <h3>Layanan Servis</h3>
                        </div>
                        <div class="card-body-modern">
                            <div class="services-grid">
                                @forelse ($mitra->services ?? [] as $service)
                                    <div class="service-tag">
                                        <i class="fas fa-check-circle"></i>
                                        {{ $service }}
                                    </div>
                                @empty
                                    <p class="text-muted">Belum ada layanan servis.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- GALLERY SECTION --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-images"></i>
                            <h3>Galeri Bengkel</h3>
                        </div>
                        <div class="card-body-modern">
                            @if ($mitra->images->count() > 0)
                                <div class="gallery-grid">
                                    @foreach ($mitra->images as $image)
                                        <div class="gallery-item-modern" data-bs-toggle="modal"
                                            data-bs-target="#galleryModal"
                                            data-image="{{ asset('storage/' . $image->image_path) }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Galeri Bengkel">
                                            <div class="gallery-overlay">
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Belum ada galeri.</p>
                            @endif
                        </div>
                    </div>

                    {{-- MAP SECTION --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Lokasi Bengkel</h3>
                        </div>
                        <div class="card-body-modern p-0">
                            <div class="map-wrapper">
                                <iframe width="100%" height="350" style="border:0; border-radius: 0 0 1rem 1rem;"
                                    loading="lazy" allowfullscreen
                                    src="https://www.google.com/maps?q={{ $mitra->latitude }},{{ $mitra->longitude }}&output=embed">
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ===== RIGHT COLUMN ===== --}}
                <div class="col-lg-4">

                    {{-- OPERATIONAL HOURS --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-clock"></i>
                            <h3>Jam Operasional</h3>
                        </div>
                        <div class="card-body-modern">
                            <div class="hours-list">
                                @foreach ($mitra->operational_hours as $day => $info)
                                    <div class="hour-item">
                                        <span class="day-name">{{ ucfirst($day) }}</span>
                                        @if (!empty($info['open']))
                                            <span class="hour-time">
                                                <i class="far fa-clock"></i>
                                                {{ $info['start'] }} - {{ $info['end'] }}
                                            </span>
                                        @else
                                            <span class="closed-text">Tutup</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- PAYMENT METHODS --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-credit-card"></i>
                            <h3>Metode Pembayaran</h3>
                        </div>
                        <div class="card-body-modern">
                            @if (!empty($mitra->payment_method))
                                <div class="payment-list">
                                    @foreach ($mitra->payment_method as $method)
                                        <div class="payment-item">
                                            <i class="fas fa-check-circle"></i>
                                            {{ $method }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Belum ada metode pembayaran.</p>
                            @endif
                        </div>
                    </div>

                    {{-- FACILITIES --}}
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <i class="fas fa-concierge-bell"></i>
                            <h3>Fasilitas</h3>
                        </div>
                        <div class="card-body-modern">
                            @if (!empty($mitra->facilities))
                                <div class="facilities-list">
                                    @foreach ($mitra->facilities as $facility)
                                        <div class="facility-item">
                                            <i class="fas fa-check-circle"></i>
                                            {{ $facility }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Belum ada fasilitas.</p>
                            @endif
                        </div>
                    </div>

                    {{-- INFO CARD --}}
                    <div class="card-modern info-card">
                        <div class="card-body-modern text-center">
                            <i class="fas fa-headset"></i>
                            <h4>Butuh Bantuan?</h4>
                            <p>Hubungi tim support kami untuk informasi lebih lanjut</p>
                            <a href="https://wa.me/6282178192938?text=Halo%20ServiCycle,%20saya%20ingin%20bertanya."
                                target="_blank" class="btn-support">
                                Hubungi Support
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- GALLERY MODAL --}}
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content-custom">
                <button type="button" class="modal-close" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
                <img id="galleryModalImage" src="" alt="Gallery Image">
            </div>
        </div>
    </div>

    <style>
        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            height: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: url('{{ $mitra->coverImage ? asset('storage/' . $mitra->coverImage->image_path) : asset('assets/images/no-image.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: white;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-rating {
            color: #FFD700;
            font-size: 1.1rem;
        }

        .hero-rating span {
            color: white;
            margin-left: 0.5rem;
        }

        /* ===== MAIN SECTION ===== */
        .main-section {
            margin-top: -60px;
            position: relative;
            z-index: 3;
            padding-bottom: 4rem;
        }

        /* ===== BACK BUTTON ===== */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: white;
            border-radius: 50px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .btn-back:hover {
            transform: translateX(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            color: #667eea;
        }

        /* ===== MODERN CARD ===== */
        .card-modern {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .cover-wrapper {
            position: relative;
            height: 100%;
            min-height: 300px;
            overflow: hidden;
        }

        .cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .cover-wrapper:hover .cover-image {
            transform: scale(1.05);
        }

        .open-badge,
        .closed-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
        }

        .open-badge {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        .closed-badge {
            background: rgba(220, 53, 69, 0.9);
            color: white;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }

        .card-modern-body {
            padding: 1.5rem;
        }

        .business-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1a1a2e;
        }

        .business-location {
            color: #666;
            font-size: 0.9rem;
        }

        .distance-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .business-description {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 0.75rem;
            margin: 1rem 0;
            position: relative;
        }

        .business-description i {
            color: #667eea;
            font-size: 1.5rem;
            opacity: 0.5;
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
        }

        .business-description p {
            margin: 0;
            padding-left: 1.5rem;
            color: #555;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary-modern,
        .btn-outline-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
        }

        .btn-primary-modern:hover:not(.disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-primary-modern.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-outline-modern {
            border: 2px solid #667eea;
            color: #667eea;
            background: white;
        }

        .btn-outline-modern:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* ===== CARD HEADER ===== */
        .card-header-modern {
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header-modern i {
            font-size: 1.25rem;
        }

        .card-header-modern h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body-modern {
            padding: 1.5rem;
        }

        /* ===== SERVICES GRID ===== */
        .services-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .service-tag {
            background: linear-gradient(135deg, #667eea20, #764ba220);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: #667eea;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .service-tag i {
            font-size: 0.8rem;
        }

        /* ===== GALLERY GRID ===== */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .gallery-item-modern {
            position: relative;
            border-radius: 0.75rem;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 1;
        }

        .gallery-item-modern img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-overlay i {
            color: white;
            font-size: 2rem;
        }

        .gallery-item-modern:hover img {
            transform: scale(1.1);
        }

        .gallery-item-modern:hover .gallery-overlay {
            opacity: 1;
        }

        /* ===== MAP ===== */
        .map-wrapper {
            border-radius: 0 0 1rem 1rem;
            overflow: hidden;
        }

        /* ===== HOURS LIST ===== */
        .hours-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .hour-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .day-name {
            font-weight: 600;
            color: #333;
            text-transform: capitalize;
        }

        .hour-time {
            color: #28a745;
            font-size: 0.9rem;
        }

        .hour-time i {
            margin-right: 0.25rem;
        }

        .closed-text {
            color: #dc3545;
            font-size: 0.9rem;
        }

        /* ===== PAYMENT & FACILITIES ===== */
        .payment-list,
        .facilities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .payment-item,
        .facility-item {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-item i,
        .facility-item i {
            color: #28a745;
            font-size: 0.8rem;
        }

        /* ===== INFO CARD ===== */
        .info-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-align: center;
        }

        .info-card .card-body-modern {
            padding: 2rem;
        }

        .info-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .info-card h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .btn-support {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-support:hover {
            background: white;
            color: #667eea;
        }

        /* ===== MODAL CUSTOM ===== */
        .modal-content-custom {
            position: relative;
            background: transparent;
            border: none;
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: -40px;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 10;
        }

        .modal-close:hover {
            transform: rotate(90deg);
        }

        #galleryModalImage {
            width: 100%;
            border-radius: 1rem;
            max-height: 80vh;
            object-fit: contain;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-section {
                height: 300px;
                background-attachment: scroll;
            }

            .hero-title {
                font-size: 2rem;
            }

            .main-section {
                margin-top: -40px;
            }

            .business-name {
                font-size: 1.3rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary-modern,
            .btn-outline-modern {
                justify-content: center;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .modal-close {
                top: -35px;
                right: -5px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gallery Modal
            const galleryItems = document.querySelectorAll('.gallery-item-modern');
            const modalImage = document.getElementById('galleryModalImage');

            galleryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    modalImage.src = imageSrc;
                });
            });

            // Booking Button Alert
            const isOpen = @json($mitra->isOpenNow());
            const bookingBtn = document.getElementById('btnBooking');

            if (bookingBtn) {
                bookingBtn.addEventListener('click', function(e) {
                    if (!isOpen) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'info',
                            title: 'Bengkel Sedang Tutup',
                            text: 'Saat ini bengkel belum buka. Silakan tunggu jam operasional atau coba booking nanti ya 🙂',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#667eea'
                        });
                    } 
                    else {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Fitur Dalam Maintenance',
                            text: 'Fitur ini sedang dalam maintenance, silahkan coba beberapa saat lagi, atau bisa datang langsung ke bengkel untuk reservasi manual',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#667eea'
                        });
                    }
                });
            }
        });
    </script>
@endsection

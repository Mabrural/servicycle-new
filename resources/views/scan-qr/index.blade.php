@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">

                        <div class="card card-rounded">
                            <div class="card-body">

                                <h4 class="card-title card-title-dash mb-3">
                                    📷 Scan QR Customer
                                </h4>

                                {{-- WRAPPER RESPONSIVE --}}
                                <div class="qr-wrapper">
                                    <div id="qr-reader"></div>
                                </div>

                                {{-- BUTTON UPLOAD ALTERNATIF --}}
                                <div class="text-center mt-3">
                                    <label class="btn btn-outline-primary">
                                        Upload QR
                                        <input type="file" accept="image/*" id="qr-upload" hidden>
                                    </label>
                                </div>

                                <form id="scanForm" method="POST" action="{{ route('scan.qr.process') }}" class="d-none">
                                    @csrf
                                    <input type="hidden" name="qr_code" id="qr_code">
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection

@push('styles')
    <style>
        .qr-wrapper {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            padding: 10px;
        }

        #qr-reader {
            width: 100% !important;
            border-radius: 12px;
            overflow: hidden;
        }

        @media (max-width: 576px) {
            .qr-wrapper {
                max-width: 100%;
                padding: 0;
            }

            #qr-reader video {
                width: 100% !important;
                height: auto !important;
                border-radius: 12px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let alreadyScanned = false;
            let scanner;

            // 🔊 PRELOAD AUDIO
            const beepSound = new Audio("{{ asset('sounds/store-scanner-beep-90395.mp3') }}");
            beepSound.preload = 'auto';

            // Fungsi scan sukses
            function onScanSuccess(decodedText) {
                if (alreadyScanned) return;
                alreadyScanned = true;

                // STOP SCANNER
                scanner.clear();

                // 🔊 PLAY BEEP
                beepSound.play().catch(() => {});

                Swal.fire({
                    icon: 'info',
                    title: 'QR Terdeteksi',
                    text: 'Memproses check-in customer...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });

                document.getElementById('qr_code').value = decodedText;

                setTimeout(() => {
                    document.getElementById('scanForm').submit();
                }, 400);
            }

            function onScanFailure(error) {}

            // Pilih kamera belakang jika ada
            async function startScanner() {
                const devices = await Html5Qrcode.getCameras();
                let cameraId = devices.find(c => c.label.toLowerCase().includes('back'))?.id || devices[0].id;

                // Simpan izin kamera di localStorage agar tidak minta lagi
                if (!localStorage.getItem('cameraAllowed')) {
                    try {
                        await navigator.mediaDevices.getUserMedia({
                            video: {
                                deviceId: cameraId
                            }
                        });
                        localStorage.setItem('cameraAllowed', 'true');
                    } catch (e) {
                        console.warn("Camera access denied");
                    }
                }

                scanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: function(w, h) {
                            let size = Math.min(w, h) * 0.7;
                            return {
                                width: size,
                                height: size
                            };
                        },
                        experimentalFeatures: {
                            useBarCodeDetectorIfSupported: true
                        }
                    },
                    false
                );

                scanner.render(onScanSuccess, onScanFailure, cameraId);
            }

            startScanner();

            // Upload QR alternatif
            document.getElementById('qr-upload').addEventListener('change', function(e) {
                if (e.target.files.length === 0) return;
                const file = e.target.files[0];
                Html5Qrcode.scanFile(file, true)
                    .then(decodedText => onScanSuccess(decodedText))
                    .catch(err => Swal.fire({
                        icon: 'error',
                        text: 'QR tidak valid'
                    }));
            });

        });
    </script>

    @if (session('scan_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Check-in Berhasil',
                    text: '{{ session('scan_success') }}',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('service-orders.index') }}";
                });
            });
        </script>
    @endif
@endpush

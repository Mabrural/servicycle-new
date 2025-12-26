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
        /* Wrapper agar QR Scanner responsive */
        .qr-wrapper {
            width: 100%;
            max-width: 420px;
            /* batas aman mobile */
            margin: 0 auto;
            /* center */
            padding: 10px;
        }

        #qr-reader {
            width: 100% !important;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Mobile optimization */
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

            function onScanSuccess(decodedText) {
                if (alreadyScanned) return;
                alreadyScanned = true;

                // STOP scanner
                scanner.clear();

                Swal.fire({
                    icon: 'info',
                    title: 'QR Terdeteksi',
                    text: 'Memproses check-in customer...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                document.getElementById('qr_code').value = decodedText;

                setTimeout(() => {
                    document.getElementById('scanForm').submit();
                }, 500);
            }

            function onScanFailure(error) {}

            scanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: function(w, h) {
                        let size = Math.min(w, h) * 0.7;
                        return {
                            width: size,
                            height: size
                        };
                    }
                },
                false
            );

            scanner.render(onScanSuccess, onScanFailure);
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

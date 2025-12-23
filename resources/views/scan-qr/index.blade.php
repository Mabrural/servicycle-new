@extends('layouts.main')

@section('container')
    <div class="container py-4">

        <h4 class="fw-bold mb-3">📷 Scan QR Customer</h4>

        <div class="card">
            <div class="card-body">

                <div id="qr-reader" style="width: 100%"></div>

                <form id="scanForm" method="POST" action="{{ route('scan.qr.process') }}" class="d-none">
                    @csrf
                    <input type="hidden" name="qr_code" id="qr_code">
                </form>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`QR Code detected: ${decodedText}`);

                document.getElementById('qr_code').value = decodedText;
                document.getElementById('scanForm').submit();
            }

            function onScanFailure(error) {
                // boleh dikosongkan agar tidak spam console
            }

            const html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                false
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush

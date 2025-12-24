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

                                <div id="qr-reader" style="width: 100%"></div>

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
                // kosongkan agar tidak spam console
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

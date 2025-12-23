@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card card-rounded shadow-sm">
                <div class="card-body text-center">

                    <i class="mdi mdi-qrcode-scan fs-1 text-primary mb-3"></i>

                    <h4 class="fw-bold mb-2">
                        Konfirmasi Check-in Customer
                    </h4>

                    <p class="text-muted mb-4">
                        Pastikan data berikut sesuai sebelum memasukkan ke antrian servis
                    </p>

                    <div class="border rounded p-3 text-start mb-4">
                        <p class="mb-1"><strong>Nama Customer:</strong> {{ $order->customer_name }}</p>
                        <p class="mb-1"><strong>No. HP:</strong> {{ $order->customer_phone }}</p>
                        <p class="mb-1"><strong>Kendaraan:</strong>
                            {{ $order->vehicle_brand_manual }}
                            {{ $order->vehicle_model_manual }}
                        </p>
                        <p class="mb-0"><strong>Plat:</strong> {{ $order->vehicle_plate_manual }}</p>
                    </div>

                    <form action="{{ route('service-orders.check-in', $order->id) }}" method="POST"
                        onsubmit="return confirm('Konfirmasi customer sudah datang ke bengkel?')">
                        @csrf

                        <button type="submit" class="btn btn-success px-4">
                            ✅ Konfirmasi Check-in
                        </button>
                    </form>

                    <div class="mt-3">
                        <a href="{{ route('service-orders.index') }}" class="text-muted small">
                            ← Kembali ke daftar servis
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

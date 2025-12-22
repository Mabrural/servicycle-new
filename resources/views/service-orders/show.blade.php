@extends('layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card card-rounded shadow-sm">
                    <div class="card-body">

                        {{-- HEADER --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="card-title mb-0">Bukti Servis</h4>
                                <small class="text-muted">
                                    No Servis: <strong>{{ $order->uuid }}</strong>
                                </small>
                            </div>

                            <span class="badge bg-success text-capitalize">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </div>

                        <hr>

                        {{-- INFO SERVIS --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Tanggal Servis</p>
                                <p class="fw-semibold">
                                    {{ $order->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Tipe Servis</p>
                                <span class="badge bg-info">
                                    {{ ucfirst($order->order_type) }}
                                </span>
                            </div>
                        </div>

                        <hr>

                        {{-- DATA PELANGGAN --}}
                        <h5 class="fw-bold mb-2">Data Pelanggan</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Nama</p>
                                <p>{{ $order->customer_name ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">No. Telepon</p>
                                <p>{{ $order->customer_phone ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- DATA KENDARAAN --}}
                        <h5 class="fw-bold mb-2 mt-3">Data Kendaraan</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Plat Nomor</p>
                                <p>{{ $order->vehicle_plate_manual ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Kendaraan</p>
                                <p>
                                    {{ $order->vehicle_brand_manual ?? '-' }}
                                    {{ $order->vehicle_model_manual ?? '' }}
                                </p>
                            </div>
                        </div>

                        <hr>

                        {{-- KELUHAN & DIAGNOSA --}}
                        <h5 class="fw-bold mb-2">Keluhan Pelanggan</h5>
                        <div class="alert alert-light">
                            {{ $order->customer_complain ?? 'Tidak ada keluhan' }}
                        </div>

                        <h5 class="fw-bold mb-2 mt-3">Diagnosa Bengkel</h5>
                        <div class="alert alert-warning">
                            {{ $order->diagnosed_problem ?? 'Belum ada diagnosa' }}
                        </div>

                        <hr>

                        {{-- BIAYA --}}
                        <h5 class="fw-bold mb-2">Ringkasan Biaya</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Estimasi Biaya</p>
                                <p>
                                    Rp {{ number_format($order->estimated_cost ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p class="mb-1 text-muted">Total Akhir</p>
                                <h4 class="text-success fw-bold">
                                    Rp {{ number_format($order->final_cost ?? 0, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <hr>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('service-orders.download', $order->id) }}"
                               class="btn btn-primary">
                                <i class="mdi mdi-download me-1"></i>
                                Download PDF
                            </a>

                            <a href="{{ route('service-orders.index') }}"
                               class="btn btn-light">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('layouts.footer')
</div>
@endsection

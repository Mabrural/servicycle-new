@extends('layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">🛠️ Servis Saya</h4>

            <a href="/" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus-circle me-1"></i>
                Servis Online
            </a>
        </div>

        {{-- TAB NAV --}}
        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <button class="nav-link active"
                        data-bs-toggle="pill"
                        data-bs-target="#waiting">
                    Menunggu ({{ $waitingOrders->count() }})
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#queue">
                    Antrian ({{ $queueOrders->count() }})
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#history">
                    Riwayat ({{ $historyOrders->count() }})
                </button>
            </li>
        </ul>

        {{-- TAB CONTENT --}}
        <div class="tab-content">

            {{-- ================= MENUNGGU ================= --}}
            <div class="tab-pane fade show active" id="waiting">
                @include('booking.partials.order-cards', [
                    'orders' => $waitingOrders,
                    'emptyText' => 'Tidak ada servis yang menunggu'
                ])
            </div>

            {{-- ================= ANTRIAN ================= --}}
            <div class="tab-pane fade" id="queue">
                @include('booking.partials.order-cards', [
                    'orders' => $queueOrders,
                    'emptyText' => 'Tidak ada servis yang sedang diproses'
                ])
            </div>

            {{-- ================= RIWAYAT ================= --}}
            <div class="tab-pane fade" id="history">
                @include('booking.partials.order-cards', [
                    'orders' => $historyOrders,
                    'emptyText' => 'Belum ada riwayat servis'
                ])
            </div>

        </div>
    </div>
</div>
@endsection

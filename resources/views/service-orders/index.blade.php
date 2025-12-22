@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">

                        {{-- TAB NAV --}}
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" data-bs-toggle="tab" href="#incoming">
                                        Booking Masuk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#queue">
                                        Antrian Servis
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#history">
                                        Riwayat
                                    </a>
                                </li>
                            </ul>

                            {{-- ACTION BUTTON --}}
                            <div class="btn-wrapper">
                                <a href="{{ route('service-orders.walk_in.create') }}" class="btn btn-primary text-white">
                                    <i class="mdi mdi-plus-circle me-1"></i>
                                    Servis Walk-In
                                </a>
                            </div>
                        </div>


                        {{-- TAB CONTENT --}}
                        <div class="tab-content tab-content-basic mt-3">

                            {{-- ================= BOOKING MASUK ================= --}}
                            <div class="tab-pane fade show active" id="incoming">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <h4 class="card-title card-title-dash">Booking Online Masuk</h4>
                                        <p class="card-subtitle card-subtitle-dash">
                                            Booking yang menunggu persetujuan bengkel
                                        </p>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pelanggan</th>
                                                        <th>Kendaraan</th>
                                                        <th>Keluhan</th>
                                                        <th>Tipe</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($pendingOrders as $index => $order)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <strong>{{ $order->customer_name ?? $order->customer?->name }}</strong><br>
                                                                <small>{{ $order->customer_phone }}</small>
                                                            </td>
                                                            <td>
                                                                {{ $order->vehicle?->plate_number ?? ($order->vehicle_plate_manual ?? '-') }}
                                                            </td>
                                                            <td>{{ $order->customer_complain ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge bg-info">Online</span>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('service-orders.accept', $order->id) }}"
                                                                    method="POST" class="d-inline accept-form">
                                                                    @csrf
                                                                    <button class="btn btn-success btn-sm">
                                                                        <i class="mdi mdi-check"></i>
                                                                    </button>
                                                                </form>

                                                                <form
                                                                    action="{{ route('service-orders.reject', $order->id) }}"
                                                                    method="POST" class="d-inline reject-form">
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm">
                                                                        <i class="mdi mdi-close"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">
                                                                Tidak ada booking masuk
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= ANTRIAN SERVIS ================= --}}
                            <div class="tab-pane fade" id="queue">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <h4 class="card-title card-title-dash">Antrian Servis Aktif</h4>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No Antrian</th>
                                                        <th>Pelanggan</th>
                                                        <th>Kendaraan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($queueOrders as $order)
                                                        <tr>
                                                            <td>
                                                                <span class="badge bg-primary">
                                                                    {{ $order->queue_number }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $order->customer_name ?? '-' }}</td>
                                                            <td>{{ $order->vehicle_plate_manual ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge bg-warning">
                                                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if ($order->status === 'waiting')
                                                                    <form
                                                                        action="{{ route('service-orders.start', $order->id) }}"
                                                                        method="POST" class="d-inline start-form">
                                                                        @csrf
                                                                        <button class="btn btn-primary btn-sm">
                                                                            Mulai
                                                                        </button>
                                                                    </form>
                                                                @elseif ($order->status === 'in_progress')
                                                                    <form
                                                                        action="{{ route('service-orders.finish', $order->id) }}"
                                                                        method="POST" class="d-inline finish-form">
                                                                        @csrf
                                                                        <button class="btn btn-success btn-sm">
                                                                            Selesai
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">
                                                                Tidak ada antrian aktif
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= RIWAYAT ================= --}}
                            <div class="tab-pane fade" id="history">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <h4 class="card-title card-title-dash">Riwayat Servis</h4>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Pelanggan</th>
                                                        <th>Kendaraan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($historyOrders as $order)
                                                        <tr>
                                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                                            <td>{{ $order->customer_name ?? '-' }}</td>
                                                            <td>{{ $order->vehicle_plate_manual ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge bg-success">
                                                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">
                                                                Belum ada riwayat servis
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                function confirmAction(form, title, text, icon) {
                    event.preventDefault();
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    }).then(result => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }

                document.querySelectorAll('.accept-form').forEach(form => {
                    form.addEventListener('submit', e => confirmAction(form,
                        'Terima Booking?',
                        'Booking akan menunggu kedatangan pelanggan',
                        'question'
                    ));
                });

                document.querySelectorAll('.reject-form').forEach(form => {
                    form.addEventListener('submit', e => confirmAction(form,
                        'Tolak Booking?',
                        'Booking akan dibatalkan',
                        'warning'
                    ));
                });

                document.querySelectorAll('.start-form').forEach(form => {
                    form.addEventListener('submit', e => confirmAction(form,
                        'Mulai Servis?',
                        'Servis akan dimulai',
                        'question'
                    ));
                });

                document.querySelectorAll('.finish-form').forEach(form => {
                    form.addEventListener('submit', e => confirmAction(form,
                        'Selesaikan Servis?',
                        'Status servis akan selesai',
                        'success'
                    ));
                });

            });
        </script>
    @endpush
@endsection

@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <form method="GET" class="row g-2 align-items-center mb-3">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Cari nama / no HP / plat">
                            </div>

                            <div class="col-md-2">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    @foreach ([10, 15, 20, 100] as $size)
                                        <option value="{{ $size }}"
                                            {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                            {{ $size }} / halaman
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-outline-primary">
                                    <i class="mdi mdi-magnify"></i> Cari
                                </button>
                            </div>
                        </form>


                        {{-- TAB NAV --}}
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#history">
                                        Bukti Servis
                                        <span class="badge bg-secondary ms-1">
                                            {{ $counts['history'] }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                        {{-- TAB CONTENT --}}
                        <div class="tab-content tab-content-basic mt-3">


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
                                                        <th>Kendaraan</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($historyOrders as $order)
                                                        <tr>
                                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                {{ $order->vehicle?->plate_number ?? ($order->vehicle_plate_manual ?? '-') }}
                                                                <br>
                                                                <small>{{ $order->vehicle?->brand }}
                                                                    {{ $order->vehicle?->model }}
                                                                    {{ $order->vehicle?->tahun }} -
                                                                    {{ $order->vehicle?->vehicle_type }}</small>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $status = $order->status;

                                                                    $badgeClass = match ($status) {
                                                                        'rejected',
                                                                        'cancelled',
                                                                        'no_show'
                                                                            => 'bg-danger',
                                                                        'done', 'picked_up' => 'bg-success',
                                                                        default => 'bg-secondary',
                                                                    };
                                                                @endphp

                                                                <span class="badge {{ $badgeClass }}">
                                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                                </span>
                                                            </td>

                                                            <td>
                                                                Rp {{ number_format($order->final_cost, 0, ',', '.') }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('service-orders.show', $order->id) }}"
                                                                    class="btn btn-info btn-sm text-white">
                                                                    Detail
                                                                </a>

                                                                <a href="{{ route('service-orders.download', $order->id) }}"
                                                                    class="btn btn-outline-danger btn-sm">
                                                                    Bukti Servis PDF
                                                                </a>
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

                                        {{-- CUSTOM PAGINATION --}}
                                        @if ($historyOrders->hasPages())
                                            <div class="custom-pagination-wrapper mt-4">
                                                <ul class="custom-pagination">

                                                    {{-- PREVIOUS --}}
                                                    @if ($historyOrders->onFirstPage())
                                                        <li class="disabled">
                                                            <span>&laquo;</span>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ $historyOrders->previousPageUrl() }}"
                                                                rel="prev">&laquo;</a>
                                                        </li>
                                                    @endif

                                                    {{-- PAGE NUMBERS --}}
                                                    @foreach ($historyOrders->getUrlRange(1, $historyOrders->lastPage()) as $page => $url)
                                                        @if ($page == $historyOrders->currentPage())
                                                            <li class="active">
                                                                <span>{{ $page }}</span>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                    {{-- NEXT --}}
                                                    @if ($historyOrders->hasMorePages())
                                                        <li>
                                                            <a href="{{ $historyOrders->nextPageUrl() }}"
                                                                rel="next">&raquo;</a>
                                                        </li>
                                                    @else
                                                        <li class="disabled">
                                                            <span>&raquo;</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        @endif

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

    <div class="modal fade" id="complainModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Keluhan Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="fw-bold" id="complainCustomer"></p>
                    <p id="complainText" class="mb-0 text-muted">
                    </p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>


    <!-- MODAL SELESAI SERVIS -->
    <div class="modal fade" id="finishModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="finishForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selesaikan Servis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <textarea name="customer_complain" id="modal_complain" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnosa Masalah <span class="text-danger">*</span></label>
                            <textarea name="diagnosed_problem" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Biaya Akhir <span class="text-danger">*</span></label>
                            <input type="number" name="final_cost" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            Simpan & Selesaikan
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const finishModal = new bootstrap.Modal(document.getElementById('finishModal'));
                const finishForm = document.getElementById('finishForm');

                document.querySelectorAll('.btn-finish').forEach(btn => {
                    btn.addEventListener('click', function() {

                        const orderId = this.dataset.id;
                        const complain = this.dataset.complain ?? '';

                        finishForm.action = `/service-orders/${orderId}/finish`;

                        document.getElementById('modal_complain').value = complain;

                        finishModal.show();
                    });
                });

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const complainModal = new bootstrap.Modal(document.getElementById('complainModal'));

                document.querySelectorAll('.btn-complain').forEach(btn => {
                    btn.addEventListener('click', function() {

                        document.getElementById('complainCustomer').innerText =
                            this.dataset.customer ?? 'Pelanggan';

                        document.getElementById('complainText').innerText =
                            this.dataset.complain || 'Tidak ada keluhan';

                        complainModal.show();
                    });
                });

            });
        </script>
    @endpush
@endsection

@push('styles')
    <style>
        .custom-pagination-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        .custom-pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .custom-pagination li {
            min-width: 36px;
            height: 36px;
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-pagination li a,
        .custom-pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            color: #6c757d;
            background: #f8f9fa;
            transition: all 0.2s ease;
        }

        .custom-pagination li a:hover {
            background: #0d6efd;
            color: #fff;
        }

        .custom-pagination li.active span {
            background: #0d6efd;
            color: #fff;
        }

        .custom-pagination li.disabled span {
            background: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
        }

        /* MOBILE FRIENDLY */
        @media (max-width: 576px) {
            .custom-pagination-wrapper {
                justify-content: center;
            }

            .custom-pagination li {
                min-width: 32px;
                height: 32px;
            }
        }
    </style>
@endpush

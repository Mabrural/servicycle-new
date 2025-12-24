@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card card-rounded shadow-sm">
                        <div class="card-body">

                            <div class="mb-4">
                                <h4 class="fw-bold mb-1">🎟️ Kupon & Diskon</h4>
                                <small class="text-muted">Kelola kupon promo & akses lifetime</small>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- FORM TAMBAH --}}
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title mb-3 fw-semibold">Buat Kupon Baru</h6>
                                    <form method="POST" action="{{ route('admin.coupons.store') }}" id="couponForm">
                                        @csrf

                                        <div class="row g-3">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label class="form-label">Untuk Role <span
                                                        class="text-danger">*</span></label>
                                                <select name="role" class="form-select text-dark" required>
                                                    <option value="">Pilih role</option>
                                                    <option value="customer"
                                                        {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                                    <option value="mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>
                                                        Mitra</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-2">
                                                <label class="form-label">Diskon <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" name="discount" class="form-control"
                                                        placeholder="0" min="0" value="{{ old('discount') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-2">
                                                <label class="form-label">Max Klaim</label>
                                                <input type="number" name="max_usage" class="form-control" min="1"
                                                    value="{{ old('max_usage') }}" placeholder="Tanpa batas">
                                                <small class="text-muted">Kosongkan untuk unlimited</small>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-2">
                                                <label class="form-label" id="expiredLabel">Tanggal Expired <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="expired_at" id="expiredDate"
                                                    class="form-control" value="{{ old('expired_at') }}">
                                                <small class="text-muted" id="expiredHelp">Pilih tanggal expired
                                                    kupon</small>
                                            </div>

                                            {{-- CHECKBOX LIFETIME --}}
                                            <div class="col-12 col-md-6 col-lg-2 responsive">
                                                <div class="h-100 d-flex flex-column justify-content-end">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="is_lifetime"
                                                            value="1" id="lifetimeSwitch"
                                                            {{ old('is_lifetime') ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-semibold" for="lifetimeSwitch">
                                                            Lifetime Access
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">
                                                        Kupon tanpa tanggal expired
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <button type="submit" class="btn btn-primary px-4">
                                                    <i class="mdi mdi-plus me-1"></i> Buat Kupon
                                                </button>
                                                <button type="reset" class="btn btn-outline-secondary text-dark ms-2">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- TABLE --}}
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-3 fw-semibold">Daftar Kupon</h6>

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle" id="couponsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="ps-3">Kode</th>
                                                    <th>Role</th>
                                                    <th>Diskon</th>
                                                    <th>Pemakaian</th>
                                                    <th>Expired</th>
                                                    <th>Status</th>
                                                    <th class="text-center pe-3">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($coupons as $coupon)
                                                    <tr class="{{ $coupon->isValid() ? '' : 'table-secondary' }}">
                                                        <td class="fw-bold ps-3">
                                                            <span class="copy-code" style="cursor: pointer;"
                                                                data-code="{{ $coupon->code }}" title="Klik untuk copy">
                                                                {{ $coupon->code }}
                                                            </span>
                                                            @if ($coupon->is_lifetime)
                                                                <i class="mdi mdi-infinite ms-1 text-success"
                                                                    title="Lifetime"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($coupon->role == 'customer')
                                                                <span class="badge bg-primary">
                                                                    <i class="mdi mdi-account me-1"></i> Customer
                                                                </span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">
                                                                    <i class="mdi mdi-handshake me-1"></i> Mitra
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($coupon->discount > 0)
                                                                <span class="text-success fw-semibold">
                                                                    Rp {{ number_format($coupon->discount, 0, ',', '.') }}
                                                                </span>
                                                            @else
                                                                <span class="text-info fw-semibold">Gratis</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="progress" style="height: 6px;"
                                                                title="{{ $coupon->used_count }} dari {{ $coupon->max_usage ?? '∞' }} penggunaan">
                                                                @php
                                                                    $percentage = $coupon->max_usage
                                                                        ? min(
                                                                            100,
                                                                            ($coupon->used_count / $coupon->max_usage) *
                                                                                100,
                                                                        )
                                                                        : 0;
                                                                @endphp
                                                                <div class="progress-bar {{ $percentage >= 80 ? 'bg-danger' : 'bg-success' }}"
                                                                    style="width: {{ $percentage }}%">
                                                                </div>
                                                            </div>
                                                            <small class="d-block mt-1">
                                                                {{ $coupon->used_count }}
                                                                @if ($coupon->max_usage)
                                                                    / {{ $coupon->max_usage }}
                                                                @else
                                                                    / ∞
                                                                @endif
                                                            </small>
                                                        </td>
                                                        <td>
                                                            @if ($coupon->is_lifetime)
                                                                <span class="badge bg-dark">Lifetime</span>
                                                            @else
                                                                <span
                                                                    class="{{ $coupon->isExpired() ? 'text-danger' : 'text-success' }}">
                                                                    {{ $coupon->expired_at->format('d M Y') }}
                                                                </span>
                                                                @if ($coupon->expired_at->isToday())
                                                                    <span class="badge bg-warning text-dark ms-1">Hari
                                                                        ini</span>
                                                                @elseif($coupon->expired_at->isPast())
                                                                    <span class="badge bg-danger ms-1">Expired</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($coupon->isValid())
                                                                <span class="badge bg-success">
                                                                    <i class="mdi mdi-check-circle me-1"></i> Aktif
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger">
                                                                    <i class="mdi mdi-close-circle me-1"></i> Nonaktif
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center pe-3">
                                                            <form
                                                                action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                                method="POST" class="d-inline delete-form"
                                                                data-coupon="{{ $coupon->code }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger delete-btn">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted mb-2">
                                                                <i class="mdi mdi-ticket-outline display-4"></i>
                                                            </div>
                                                            <p class="mb-0">Belum ada kupon yang dibuat</p>
                                                            <small>Mulai dengan membuat kupon pertama Anda</small>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    @if ($coupons->hasPages())
                                        <div class="mt-4">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center mb-0">
                                                    {{ $coupons->links('vendor.pagination.bootstrap-5') }}
                                                </ul>
                                            </nav>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kupon <strong id="couponCode"></strong>?</p>
                    <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* General improvements */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card .card {
            box-shadow: none;
            border: 1px solid #e9ecef;
        }

        /* Form styling */
        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        /* Table improvements */
        #couponsTable {
            font-size: 0.9rem;
        }

        #couponsTable th {
            font-weight: 600;
            white-space: nowrap;
            border-top: none;
        }

        #couponsTable td {
            vertical-align: middle;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .copy-code:hover {
            color: #0d6efd;
            text-decoration: underline;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 10px;
            width: 60px;
            margin-bottom: 4px;
        }

        .progress-bar {
            border-radius: 10px;
        }

        /* Status badges */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .form-label {
                font-size: 0.875rem;
                margin-bottom: 0.25rem;
            }

            #couponsTable {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            #couponsTable thead th,
            #couponsTable tbody td {
                min-width: 120px;
            }

            #couponsTable td:nth-child(4),
            /* Usage column */
            #couponsTable td:nth-child(5) {
                /* Expired column */
                min-width: 140px;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .btn.ms-2 {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 576px) {
            .row.g-3>div {
                margin-bottom: 1rem;
            }

            .form-switch {
                margin-top: 0.5rem;
            }

            #couponsTable {
                font-size: 0.85rem;
            }

            .badge {
                font-size: 0.75em;
            }

            .modal-dialog {
                margin: 0.5rem;
            }
        }

        /* Empty state styling */
        .text-muted .display-4 {
            opacity: 0.5;
        }

        /* Pagination styling */
        .pagination .page-link {
            border: none;
            color: #6c757d;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 6px;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }

        /* Hover effects */
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.02);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lifetime switch functionality
            const lifetimeSwitch = document.getElementById('lifetimeSwitch');
            const expiredDate = document.getElementById('expiredDate');
            const expiredLabel = document.getElementById('expiredLabel');
            const expiredHelp = document.getElementById('expiredHelp');

            function toggleExpiredField() {
                if (lifetimeSwitch.checked) {
                    expiredDate.disabled = true;
                    expiredDate.required = false;
                    expiredDate.value = '';
                    expiredLabel.innerHTML = 'Tanggal Expired';
                    expiredHelp.textContent = 'Disabled untuk kupon lifetime';
                    expiredHelp.classList.add('text-success');
                } else {
                    expiredDate.disabled = false;
                    expiredDate.required = true;
                    expiredLabel.innerHTML = 'Tanggal Expired <span class="text-danger">*</span>';
                    expiredHelp.textContent = 'Pilih tanggal expired kupon';
                    expiredHelp.classList.remove('text-success');
                }
            }

            // Initialize
            toggleExpiredField();

            // Add event listener
            lifetimeSwitch.addEventListener('change', toggleExpiredField);

            // Copy coupon code functionality
            document.querySelectorAll('.copy-code').forEach(element => {
                element.addEventListener('click', function() {
                    const code = this.getAttribute('data-code');
                    navigator.clipboard.writeText(code).then(() => {
                        const originalText = this.textContent;
                        this.textContent = 'Copied!';
                        this.classList.add('text-success');

                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.remove('text-success');
                        }, 1500);
                    });
                });
            });

            // Delete confirmation
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const couponCodeSpan = document.getElementById('couponCode');

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const couponCode = form.getAttribute('data-coupon');

                    couponCodeSpan.textContent = couponCode;
                    deleteForm.action = form.action;
                    deleteModal.show();
                });
            });

            // Form validation
            const couponForm = document.getElementById('couponForm');
            couponForm.addEventListener('submit', function(e) {
                const discount = this.querySelector('input[name="discount"]').value;
                const role = this.querySelector('select[name="role"]').value;

                if (!role) {
                    e.preventDefault();
                    alert('Pilih role terlebih dahulu');
                    return;
                }

                if (!discount || discount <= 0) {
                    e.preventDefault();
                    alert('Diskon harus diisi dengan nilai lebih dari 0');
                    return;
                }

                if (!lifetimeSwitch.checked && !expiredDate.value) {
                    e.preventDefault();
                    alert('Pilih tanggal expired atau centang lifetime');
                    return;
                }
            });

            // Set minimum date for expired date (tomorrow)
            if (expiredDate) {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                const minDate = tomorrow.toISOString().split('T')[0];
                expiredDate.min = minDate;

                // Set placeholder date if empty
                if (!expiredDate.value) {
                    const placeholderDate = new Date();
                    placeholderDate.setMonth(placeholderDate.getMonth() + 1);
                    expiredDate.placeholder = placeholderDate.toISOString().split('T')[0];
                }
            }

            // Responsive table enhancements
            function adjustTableForMobile() {
                const table = document.getElementById('couponsTable');
                if (window.innerWidth < 768) {
                    table.classList.add('table-sm');
                } else {
                    table.classList.remove('table-sm');
                }
            }

            // Initial adjustment
            adjustTableForMobile();

            // Adjust on resize
            window.addEventListener('resize', adjustTableForMobile);
        });
    </script>
@endpush

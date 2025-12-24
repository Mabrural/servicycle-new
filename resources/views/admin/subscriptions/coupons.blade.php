@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">

                        <div class="card card-rounded">
                            <div class="card-body">

                                <h4 class="card-title card-title-dash">
                                    🎟️ Kupon & Diskon
                                </h4>
                                <p class="card-subtitle card-subtitle-dash">
                                    Kelola kupon promo & akses lifetime
                                </p>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                {{-- FORM TAMBAH --}}
                                <form method="POST" action="{{ route('admin.coupons.store') }}" class="row g-2 mb-4">
                                    @csrf

                                    <div class="col-md-3">
                                        <select name="role" class="form-select" required>
                                            <option value="">Untuk Role</option>
                                            <option value="customer">Customer</option>
                                            <option value="mitra">Mitra</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" name="discount" class="form-control"
                                            placeholder="Diskon (Rp)">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" name="max_usage" class="form-control" placeholder="Max Klaim">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="date" name="expired_at" class="form-control">
                                    </div>

                                    <div class="col-md-2 d-flex align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_lifetime" class="form-check-input"
                                                value="1">
                                            <label class="form-check-label">Lifetime</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary text-white">
                                            <i class="mdi mdi-plus"></i> Buat Kupon
                                        </button>
                                    </div>
                                </form>

                                {{-- TABLE --}}
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Role</th>
                                                <th>Diskon</th>
                                                <th>Pemakaian</th>
                                                <th>Expired</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($coupons as $coupon)
                                                <tr>
                                                    <td><strong>{{ $coupon->code }}</strong></td>
                                                    <td>
                                                        <span class="badge bg-info">
                                                            {{ ucfirst($coupon->role) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ $coupon->discount > 0 ? 'Rp ' . number_format($coupon->discount) : 'Gratis' }}
                                                    </td>
                                                    <td>
                                                        {{ $coupon->used_count }}
                                                        @if ($coupon->max_usage)
                                                            / {{ $coupon->max_usage }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $coupon->expired_at?->format('d M Y') ?? '∞' }}
                                                    </td>
                                                    <td>
                                                        @if ($coupon->isValid())
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-danger">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">
                                                        Belum ada kupon
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{ $coupons->links() }}

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
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus kupon?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, hapus'
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

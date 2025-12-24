@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">

                    <div class="card card-rounded shadow-sm">
                        <div class="card-body">

                            {{-- HEADER --}}
                            <div class="mb-4 border-bottom pb-2">
                                <h4 class="fw-bold mb-1">
                                    Kelola Subscription
                                </h4>
                                <p class="text-muted mb-0">
                                    User: <strong>{{ $user->name }}</strong>
                                </p>
                            </div>

                            <form method="POST" action="{{ route('admin.subscriptions.users.update', $user) }}">
                                @csrf
                                @method('PUT')

                                {{-- ================= DURASI ================= --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        Durasi Subscription (bulan)
                                    </label>

                                    <input type="number" name="duration_month" class="form-control" placeholder="Contoh: 1"
                                        min="1" value="{{ old('duration_month', 1) }}">

                                    <small class="text-muted d-block mt-1">
                                        • Kosongkan → default 1 bulan<br>
                                        • Centang Lifetime → durasi diabaikan
                                    </small>
                                </div>
                                {{-- ================= PRICE ================= --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        Harga Subscription
                                    </label>

                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Contoh: 150000" value="{{ old('price', $subscription->price) }}">

                                    <small class="text-muted">
                                        Harga sebelum diskon
                                    </small>
                                </div>


                                {{-- ================= COUPON ================= --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        Coupon (opsional)
                                    </label>

                                    <select name="coupon_code" class="form-select">
                                        <option value="">- Tanpa Coupon -</option>
                                        @foreach ($coupons as $coupon)
                                            <option value="{{ $coupon->code }}">
                                                {{ $coupon->code }} ({{ $coupon->discount }}%)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- ================= LIFETIME ================= --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold d-block mb-2">
                                        Tipe Subscription
                                    </label>

                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap gap-2 p-3 border rounded">
                                        <div>
                                            <span class="fw-semibold d-block">
                                                Lifetime
                                            </span>
                                            <small class="text-muted">
                                                Subscription tanpa batas waktu
                                            </small>
                                        </div>

                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_lifetime" value="1"
                                                {{ old('is_lifetime', $subscription->is_lifetime ?? false) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= NOTES ================= --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        Catatan Admin
                                    </label>

                                    <textarea name="notes" class="form-control" rows="3" placeholder="Catatan internal (opsional)">{{ old('notes', $subscription->notes ?? '') }}</textarea>
                                </div>

                                <hr>

                                {{-- ================= ACTION ================= --}}
                                <div class="d-flex flex-wrap justify-content-between gap-2">

                                    <div>
                                        <button class="btn btn-success px-4">
                                            <i class="mdi mdi-content-save me-1"></i>
                                            Simpan
                                        </button>

                                        <a href="{{ route('admin.subscriptions.users.index') }}" class="btn btn-light px-4">
                                            Kembali
                                        </a>
                                    </div>

                                    {{-- DELETE --}}
                                    @if ($subscription->exists)
                                        <form method="POST"
                                            action="{{ route('admin.subscriptions.users.destroy', $user) }}"
                                            class="delete-subscription-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-delete-subscription px-4">
                                                <i class="mdi mdi-delete me-1"></i>
                                                Hapus Subscription
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-delete-subscription').forEach(button => {
                button.addEventListener('click', function() {

                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Hapus Subscription?',
                        text: 'Subscription user ini akan dihapus permanen.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // ✅ submit hanya di sini
                        }
                    });

                });
            });

        });
    </script>
@endpush

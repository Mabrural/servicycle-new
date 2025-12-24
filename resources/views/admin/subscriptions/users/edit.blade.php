@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card card-rounded">
                <div class="card-body">

                    <h4 class="card-title card-title-dash">
                        Kelola Subscription: {{ $user->name }}
                    </h4>

                    <form method="POST" action="{{ route('admin.subscriptions.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_pro" class="form-select">
                                <option value="0"
                                    {{ old('is_pro', $subscription->is_pro ?? false) == false ? 'selected' : '' }}>
                                    FREE
                                </option>
                                <option value="1"
                                    {{ old('is_pro', $subscription->is_pro ?? false) == true ? 'selected' : '' }}>
                                    PRO
                                </option>
                            </select>
                        </div>

                        {{-- DURASI --}}
                        <div class="mb-3">
                            <label>Durasi (bulan)</label>
                            <input type="number" name="duration_month" class="form-control" placeholder="Contoh: 1"
                                value="{{ old('duration_month') }}">
                        </div>

                        {{-- COUPON --}}
                        <div class="mb-3">
                            <label>Coupon</label>
                            <select name="coupon_code" class="form-select">
                                <option value="">- Tanpa Coupon -</option>
                                @foreach ($coupons as $coupon)
                                    <option value="{{ $coupon->code }}">
                                        {{ $coupon->code }} ({{ $coupon->discount }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- LIFETIME --}}
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_lifetime" value="1"
                                {{ old('is_lifetime', $subscription->is_lifetime ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label">Lifetime</label>
                        </div>

                        {{-- NOTES --}}
                        <div class="mb-3">
                            <label>Catatan Admin</label>
                            <textarea name="notes" class="form-control">{{ old('notes', $subscription->notes ?? '') }}</textarea>
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.subscriptions.users.index') }}" class="btn btn-light">
                                    Kembali
                                </a>
                            </div>

                            {{-- DELETE ONLY IF EXISTS --}}
                            @if ($subscription->exists)
                                <form method="POST" action="{{ route('admin.subscriptions.users.destroy', $user) }}"
                                    class="delete-subscription-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-delete-subscription">
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

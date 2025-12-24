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

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_pro" class="form-select">
                                <option value="0">FREE</option>
                                <option value="1" {{ $subscription?->is_pro ? 'selected' : '' }}>PRO</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Durasi (bulan)</label>
                            <input type="number" name="duration_month" class="form-control" placeholder="Contoh: 1">
                        </div>

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

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_lifetime" value="1">
                            <label class="form-check-label">Lifetime</label>
                        </div>

                        <div class="mb-3">
                            <label>Catatan Admin</label>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.subscriptions.users.index') }}" class="btn btn-light">Kembali</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

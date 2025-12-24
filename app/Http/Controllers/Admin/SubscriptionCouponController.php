<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionCouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = SubscriptionCoupon::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('code', 'like', "%{$request->search}%")
                  ->orWhere('role', $request->search);
            })
            ->orderByDesc('created_at')
            ->paginate($request->per_page ?? 10)
            ->withQueryString();

        return view('admin.subscriptions.coupons', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:customer,mitra',
            'discount' => 'nullable|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
            'expired_at' => 'nullable|date',
            'is_lifetime' => 'nullable|boolean',
        ]);

        SubscriptionCoupon::create([
            'code' => strtoupper(Str::random(8)),
            'role' => $request->role,
            'discount' => $request->discount ?? 0,
            'is_lifetime' => $request->boolean('is_lifetime'),
            'max_usage' => $request->max_usage,
            'used_count' => 0,
            'expired_at' => $request->expired_at,
        ]);

        return back()->with('success', 'Kupon berhasil dibuat');
    }

    public function update(Request $request, SubscriptionCoupon $coupon)
    {
        $request->validate([
            'discount' => 'nullable|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
            'expired_at' => 'nullable|date',
            'is_lifetime' => 'nullable|boolean',
        ]);

        $coupon->update([
            'discount' => $request->discount ?? $coupon->discount,
            'max_usage' => $request->max_usage,
            'expired_at' => $request->expired_at,
            'is_lifetime' => $request->boolean('is_lifetime'),
        ]);

        return back()->with('success', 'Kupon berhasil diperbarui');
    }

    public function destroy(SubscriptionCoupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Kupon berhasil dihapus');
    }
}

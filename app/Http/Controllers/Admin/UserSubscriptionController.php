<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\SubscriptionCoupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SubscriptionSetting;

class UserSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;

        $query = User::query()
            ->with('subscription')
            ->whereIn('role', ['customer', 'mitra']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString(); // ⬅ penting agar search & per_page tidak hilang

        return view('admin.subscriptions.users.index', compact('users'));
    }


    public function edit(User $user)
    {
        $subscription = UserSubscription::firstOrNew([
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        // ⬇️ JIKA BARU & PRICE MASIH NULL → AMBIL DEFAULT
        if (!$subscription->exists || is_null($subscription->price)) {

            $setting = SubscriptionSetting::first(); // asumsi cuma 1 row

            if ($setting) {
                $subscription->price = $user->role === 'customer'
                    ? $setting->customer_price
                    : $setting->mitra_price;
            }
        }

        $coupons = SubscriptionCoupon::where('role', $user->role)->get();

        return view('admin.subscriptions.users.edit', compact(
            'user',
            'subscription',
            'coupons'
        ));
    }


    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'duration_month' => 'nullable|integer|min:1',
            'coupon_code' => 'nullable|string',
            'is_lifetime' => 'nullable|boolean',
            'price' => 'nullable|integer|min:0',
            'notes' => 'nullable|string'
        ]);


        $subscription = UserSubscription::firstOrNew([
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        $subscription->is_pro = true;
        $subscription->notes = $data['notes'];
        $subscription->price = $data['price'] ?? null;


        // Lifetime
        if ($request->boolean('is_lifetime')) {
            $subscription->is_lifetime = true;
            $subscription->start_at = now();
            $subscription->end_at = null;
        } else {
            $subscription->is_lifetime = false;
            $months = $data['duration_month'] ?? 1;
            $subscription->start_at = now();
            $subscription->end_at = now()->addMonths($months);
        }

        // Coupon
        if ($request->coupon_code) {
            $coupon = SubscriptionCoupon::where('code', $request->coupon_code)->first();

            if ($coupon && $coupon->isValid()) {
                $subscription->discount = $coupon->discount;
                $subscription->is_lifetime = $coupon->is_lifetime;

                $coupon->increment('used_count');
            }
        }

        if (is_null($subscription->price)) {
            $setting = SubscriptionSetting::first();

            if ($setting) {
                $subscription->price = $user->role === 'customer'
                    ? $setting->customer_price
                    : $setting->mitra_price;
            }
        }


        $subscription->save();

        return redirect()
            ->route('admin.subscriptions.users.index')
            ->with('success', 'Subscription user berhasil diperbarui');
    }
    public function destroy(User $user)
    {
        $subscription = UserSubscription::where('user_id', $user->id)
            ->where('role', $user->role)
            ->first();

        if (!$subscription) {
            return redirect()
                ->route('admin.subscriptions.users.index')
                ->with('error', 'Subscription tidak ditemukan');
        }

        $subscription->delete();

        return redirect()
            ->route('admin.subscriptions.users.index')
            ->with('success', 'Subscription user berhasil dihapus');
    }

}

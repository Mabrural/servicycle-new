<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\SubscriptionCoupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->with('subscription')
            ->whereIn('role', ['customer', 'mitra']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $users = $query->paginate($request->per_page ?? 10);

        return view('admin.subscriptions.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $subscription = $user->subscription;
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
            'is_pro' => 'required|boolean',
            'duration_month' => 'nullable|integer|min:1',
            'coupon_code' => 'nullable|string',
            'is_lifetime' => 'nullable|boolean',
            'notes' => 'nullable|string'
        ]);

        $subscription = UserSubscription::firstOrNew([
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        $subscription->is_pro = $data['is_pro'];
        $subscription->notes = $data['notes'];

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

        $subscription->save();

        return redirect()
            ->route('admin.subscriptions.users.index')
            ->with('success', 'Subscription user berhasil diperbarui');
    }
}

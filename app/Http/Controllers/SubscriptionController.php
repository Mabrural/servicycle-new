<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionSetting;
use App\Models\UserSubscription;
use App\Models\SubscriptionCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $setting = SubscriptionSetting::first();

        // Jika sistem subscription dimatikan
        if (!$setting || !$setting->is_enabled) {
            abort(403, 'Fitur upgrade sedang dinonaktifkan');
        }

        // Ambil harga berdasarkan role
        $price = $user->role === 'mitra'
            ? $setting->mitra_price
            : $setting->customer_price;

        // Cek apakah sudah PRO
        $subscription = UserSubscription::where('user_id', $user->id)->first();

        return view('subscriptions.upgrade', compact(
            'user',
            'price',
            'subscription'
        ));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $setting = SubscriptionSetting::first();

        $price = $user->role === 'mitra'
            ? $setting->mitra_price
            : $setting->customer_price;

        $coupon = null;
        $discount = 0;
        $isLifetime = false;

        if ($request->coupon_code) {
            $coupon = SubscriptionCoupon::where('code', $request->coupon_code)
                ->where('role', $user->role)
                ->first();

            if (!$coupon || !$coupon->isValid()) {
                return back()->withErrors(['coupon_code' => 'Kode kupon tidak valid']);
            }

            $discount = $coupon->discount ?? 0;
            $isLifetime = $coupon->is_lifetime;

            $coupon->increment('used_count');
        }

        $finalPrice = max(0, $price - $discount);

        // Jika harga 0 → langsung aktif
        if ($finalPrice == 0) {
            UserSubscription::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'role' => $user->role,
                    'is_pro' => true,
                    'is_lifetime' => $isLifetime,
                    'price' => $price,
                    'discount' => $discount,
                    'start_at' => now(),
                    'end_at' => $isLifetime ? null : now()->addMonth(),
                    'notes' => 'Aktivasi manual / kupon / gratis'
                ]
            );

            return redirect()->route('dashboard')
                ->with('success', 'Akun PRO berhasil diaktifkan 🎉');
        }

        /**
         * Jika nanti pakai Tripay:
         * - Simpan pending transaction
         * - Redirect ke Tripay
         */
        return back()->with('info', 'Pembayaran online akan segera tersedia');
    }
}

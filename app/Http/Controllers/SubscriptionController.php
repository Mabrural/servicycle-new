<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionSetting;
use App\Models\SubscriptionTransaction;
use App\Models\UserSubscription;
use App\Models\SubscriptionCoupon;
use App\Services\TripayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        // === JIKA BAYAR ===
        $merchantRef = 'PRO-' . strtoupper(Str::random(10));

        $transaction = SubscriptionTransaction::create([
            'user_id' => $user->id,
            'merchant_ref' => $merchantRef,
            'amount' => $finalPrice,
            'discount' => $discount,
        ]);

        $tripay = app(TripayService::class);

        $response = $tripay->createTransaction([
            'method' => 'QRIS', // bisa dibuat pilihan nanti
            'merchant_ref' => $merchantRef,
            'amount' => $finalPrice,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items' => [
                [
                    'name' => 'Upgrade PRO',
                    'price' => $finalPrice,
                    'quantity' => 1
                ]
            ],
            'callback_url' => url('/api/tripay/callback'),
            'return_url' => route('subscription.upgrade'),
        ]);

        if (!isset($response['success']) || !$response['success']) {
            return back()->withErrors(['payment' => 'Gagal membuat transaksi']);
        }

        $transaction->update([
            'reference' => $response['data']['reference'],
            'payment_method' => $response['data']['payment_method'],
            'checkout_url' => $response['data']['checkout_url'],
            'payload' => $response,
        ]);

        return redirect($response['data']['checkout_url']);
    }
}

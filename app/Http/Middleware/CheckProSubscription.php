<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;
use App\Models\SubscriptionSetting;
use Carbon\Carbon;

class CheckProSubscription
{
    public function handle(Request $request, Closure $next)
    {
        // HARUS LOGIN
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu');
        }

        /**
         * ==========================================
         * CEK GLOBAL SETTING SUBSCRIPTION
         * Jika is_enabled = false → BYPASS
         * ==========================================
         */
        $setting = SubscriptionSetting::first();

        if ($setting && !$setting->is_enabled) {
            // Subscription system dimatikan → semua user boleh akses
            return $next($request);
        }

        /**
         * ==========================================
         * CEK SUBSCRIPTION USER (PRO)
         * ==========================================
         */
        $userId = Auth::id();
        $today = Carbon::today();

        $subscription = UserSubscription::where('user_id', $userId)
            ->where('is_pro', true)
            ->where(function ($query) use ($today) {
                $query->where('is_lifetime', true)
                    ->orWhereDate('end_at', '>=', $today);
            })
            ->first();

        // JIKA TIDAK VALID → TOLAK
        if (!$subscription) {
            abort(403, 'Akses ditolak. Fitur ini khusus pengguna PRO.');
        }

        // LOLOS SEMUA CEK → LANJUT
        return $next($request);
    }
}

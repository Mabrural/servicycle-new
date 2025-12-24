<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;

class EnsureProSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika belum login
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Ambil subscription terbaru user sesuai role
        $subscription = UserSubscription::where('user_id', $user->id)
            ->where('role', $user->role)
            ->latest()
            ->first();

        /**
         * RULE SEDERHANA:
         * - Jika BELUM ADA DATA subscription → dianggap FREE → boleh masuk
         */
        if (!$subscription) {
            return $next($request);
        }

        /**
         * Jika LIFETIME → BOLEH
         */
        if ($subscription->is_lifetime) {
            return $next($request);
        }

        /**
         * Jika PRO & masih aktif → BOLEH
         */
        if ($subscription->is_pro && $subscription->end_at && $subscription->end_at->isFuture()) {
            return $next($request);
        }

        /**
         * Jika TIDAK MEMENUHI → TOLAK
         */
        return redirect()
            ->back()
            ->with('error', 'Fitur ini hanya tersedia untuk akun PRO. Silakan upgrade.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;
use Carbon\Carbon;

class CheckProSubscription
{
    public function handle(Request $request, Closure $next)
    {
        // HARUS LOGIN
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu');
        }

        $userId = Auth::id();
        $today = Carbon::today();

        // AMBIL SUBSCRIPTION USER YANG LOGIN SAJA
        $subscription = UserSubscription::where('user_id', $userId)
            ->where('is_pro', true)
            ->where(function ($query) use ($today) {
                $query->where('is_lifetime', true)
                      ->orWhereDate('end_at', '>=', $today);
            })
            ->first();

        // JIKA TIDAK VALID → TOLAK
        if (!$subscription) {
            // return redirect()
            //     ->route('subscription.upgrade') // bebas kamu mau kemana
            //     ->with('error', 'Fitur ini hanya untuk pengguna PRO');
             abort(403, 'Akses ditolak. Khusus pro.');
        }

        // LOLOS SEMUA CEK → LANJUT
        return $next($request);
    }
}

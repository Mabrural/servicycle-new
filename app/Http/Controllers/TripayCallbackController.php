<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionTransaction;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class TripayCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $signature = hash_hmac(
            'sha256',
            $request->getContent(),
            config('tripay.private_key')
        );

        if ($request->header('X-Callback-Signature') !== $signature) {
            abort(403);
        }

        $data = $request->data;

        $transaction = SubscriptionTransaction::where('reference', $data['reference'])->firstOrFail();

        if ($data['status'] === 'PAID') {
            $transaction->update(['status' => 'PAID']);

            UserSubscription::updateOrCreate(
                ['user_id' => $transaction->user_id],
                [
                    'is_pro' => true,
                    'price' => $transaction->amount,
                    'start_at' => now(),
                    'end_at' => now()->addMonth(),
                ]
            );
        }

        return response()->json(['success' => true]);
    }
}

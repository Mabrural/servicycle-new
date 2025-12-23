<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function show($token)
    {
        // WAJIB LOGIN
        if (!auth()->check()) {
            abort(403, 'Akses ditolak');
        }

        // HARUS MITRA
        if (!auth()->user()->mitra) {
            abort(403, 'QR hanya bisa di-scan oleh bengkel');
        }

        $mitra = auth()->user()->mitra;

        $order = ServiceOrder::where('qr_token', $token)
            ->where('mitra_id', $mitra->id)
            ->firstOrFail();

        if ($order->status !== 'accepted') {
            abort(403, 'QR tidak valid');
        }

        if ($order->checked_in_at) {
            abort(403, 'Customer sudah check-in');
        }

        return view('mitra.check-in.confirm', compact('order'));
    }

    public function confirm($token)
    {
        $mitra = auth()->user()->mitra;

        $order = ServiceOrder::where('qr_token', $token)
            ->where('mitra_id', $mitra->id)
            ->firstOrFail();

        if ($order->checked_in_at) {
            return back()->with('error', 'Customer sudah check-in');
        }

        $order->update([
            'status' => 'checked_in',
            'checked_in_at' => now(),
        ]);

        return redirect()
            ->route('service-orders.index')
            ->with('success', 'Customer berhasil check-in');
    }
}

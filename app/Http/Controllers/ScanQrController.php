<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScanQrController extends Controller
{
    public function index()
    {
        return view('scan-qr.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        $qrInput = trim($request->qr_code);

        /**
         * 🔹 Ambil UUID dari:
         * - UUID langsung
         * - URL: /check-in/{uuid}
         */
        preg_match(
            '/[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}/',
            $qrInput,
            $matches
        );

        $qrToken = $matches[0] ?? null;

        if (!$qrToken || !Str::isUuid($qrToken)) {
            return back()->with('error', 'QR Code tidak valid');
        }

        $order = ServiceOrder::where('qr_token', $qrToken)->first();

        if (!$order) {
            return back()->with('error', 'QR Code tidak ditemukan');
        }

        if (in_array($order->status, ['done', 'cancelled', 'no_show'])) {
            return back()->with('error', 'Order tidak bisa di check-in');
        }

        $order->update([
            'status' => 'checked_in'
        ]);

        return redirect()
            ->route('service-orders.index')
            ->with('success', 'Customer berhasil check-in');
    }
}

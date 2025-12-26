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
         * 🔹 Ambil UUID dari QR:
         * - UUID langsung
         * - URL /check-in/{uuid}
         */
        preg_match(
            '/[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}/',
            $qrInput,
            $matches
        );

        $qrToken = $matches[0] ?? null;

        // ❌ UUID tidak valid
        if (!$qrToken || !Str::isUuid($qrToken)) {
            return back()->with('error', 'QR Code tidak valid');
        }

        $order = ServiceOrder::where('qr_token', $qrToken)->first();

        // ❌ Tidak ditemukan
        if (!$order) {
            return back()->with('error', 'QR Code tidak ditemukan');
        }

        // ❌ Sudah pernah check-in
        if ($order->checked_in_at !== null) {
            return back()->with('error', 'QR Code sudah digunakan untuk check-in');
        }

        // ❌ Status tidak boleh check-in
        if (in_array($order->status, ['done', 'cancelled', 'rejected', 'no_show'])) {
            return back()->with('error', 'Order tidak dapat di check-in');
        }

        // ✅ CHECK-IN SAH
        $order->update([
            'status' => 'checked_in',
            'checked_in_at' => now(),
        ]);

        return redirect()
            ->route('scan.qr.customer')
            ->with('scan_success', 'Customer berhasil check-in');

    }
}

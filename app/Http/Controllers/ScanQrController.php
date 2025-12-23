<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ScanQrController extends Controller
{
    public function index()
    {
        return view('scan-qr.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|uuid'
        ]);

        $order = ServiceOrder::where('qr_token', $request->qr_code)->first();

        if (!$order) {
            return back()->with('error', 'QR Code tidak valid');
        }

        if (in_array($order->status, ['done', 'cancelled', 'no_show'])) {
            return back()->with('error', 'Order tidak bisa di check-in');
        }

        $order->update([
            'status' => 'checked_in'
        ]);

        return redirect()
            ->route('service-orders.show', $order->id)
            ->with('success', 'Customer berhasil check-in');
    }
}

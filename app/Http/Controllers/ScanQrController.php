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
        $qr = $request->qr_code;

        // contoh: QR berisi service_order_id
        $order = ServiceOrder::where('qr_code', $qr)->firstOrFail();

        return redirect()
            ->route('service-orders.show', $order->id)
            ->with('success', 'QR berhasil diverifikasi');
    }
}

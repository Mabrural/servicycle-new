<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ServiceOrderController extends Controller
{
    /**
     * ===============================
     * CREATE ORDER (ONLINE / WALK-IN)
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitras,id',
            'order_type' => 'required|in:online,walk_in',

            // optional
            'customer_id' => 'nullable|exists:customers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',

            'vehicle_plate_manual' => 'nullable|string|max:20',
            'customer_name' => 'nullable|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'customer_complain' => 'nullable|string',
        ]);

        $order = ServiceOrder::create([
            'uuid' => Str::uuid(),
            'mitra_id' => $request->mitra_id,
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'created_by' => Auth::id(),
            'order_type' => $request->order_type,

            'vehicle_type_manual' => $request->vehicle_type_manual,
            'vehicle_brand_manual' => $request->vehicle_brand_manual,
            'vehicle_model_manual' => $request->vehicle_model_manual,
            'vehicle_plate_manual' => $request->vehicle_plate_manual,

            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_complain' => $request->customer_complain,

            // online = pending | walk-in = langsung datang
            'status' => $request->order_type === 'walk_in'
                ? 'waiting'
                : 'pending',
        ]);

        // walk-in langsung masuk antrian
        if ($order->order_type === 'walk_in') {
            $order->queue_number = $this->generateQueueNumber($order->mitra_id);
            $order->checked_in_at = now();
            $order->save();
        }

        return redirect()->back()->with('success', 'Order berhasil dibuat');
    }

    /**
     * ===============================
     * ACCEPT / REJECT ORDER (BENGKEL)
     * ===============================
     */
    public function accept(ServiceOrder $serviceOrder)
    {
        if ($serviceOrder->status !== 'pending') {
            return back()->with('error', 'Order tidak valid');
        }

        $serviceOrder->update([
            'status' => 'accepted',
            'accepted_at' => now(),
            'check_in_deadline' => now()->addHour(), // 1 jam
        ]);

        return back()->with('success', 'Order diterima');
    }

    public function reject(ServiceOrder $serviceOrder)
    {
        $serviceOrder->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Order ditolak');
    }

    /**
     * ===============================
     * CHECK-IN (QR / MANUAL)
     * ===============================
     */
    public function checkIn($qrToken)
    {
        $order = ServiceOrder::where('qr_token', $qrToken)->firstOrFail();

        if ($order->status !== 'accepted') {
            return back()->with('error', 'Order tidak bisa check-in');
        }

        // cek no-show
        if ($order->check_in_deadline && now()->gt($order->check_in_deadline)) {
            $order->update(['status' => 'no_show']);
            return back()->with('error', 'Order sudah no-show');
        }

        $order->update([
            'status' => 'waiting',
            'checked_in_at' => now(),
            'queue_number' => $this->generateQueueNumber($order->mitra_id),
        ]);

        return back()->with('success', 'Check-in berhasil');
    }

    /**
     * ===============================
     * UPDATE SERVICE STATUS
     * ===============================
     */
    public function start(ServiceOrder $serviceOrder)
    {
        $serviceOrder->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return back()->with('success', 'Servis dimulai');
    }

    public function finish(ServiceOrder $serviceOrder)
    {
        $serviceOrder->update([
            'status' => 'done',
            'finished_at' => now(),
        ]);

        return back()->with('success', 'Servis selesai');
    }

    public function pickUp(ServiceOrder $serviceOrder)
    {
        $serviceOrder->update([
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        return back()->with('success', 'Kendaraan diambil');
    }

    /**
     * ===============================
     * QUEUE GENERATOR (PER HARI)
     * ===============================
     */
    private function generateQueueNumber($mitraId)
    {
        return ServiceOrder::where('mitra_id', $mitraId)
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('queue_number')
            ->max('queue_number') + 1;
    }
}

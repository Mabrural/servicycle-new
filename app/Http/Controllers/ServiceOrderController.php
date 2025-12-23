<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceOrderController extends Controller
{
    /**
     * ==================================================
     * DASHBOARD BENGKEL
     * ==================================================
     */
    public function index()
    {
        $mitra = Auth::user()->mitra;

        if (!$mitra) {
            abort(403, 'Akun ini belum memiliki mitra');
        }

        $mitraId = $mitra->id;

        // ================= DATA =================

        $pendingOrders = ServiceOrder::where('mitra_id', $mitraId)
            ->whereIn('status', ['pending', 'accepted', 'checked_in'])
            ->latest()
            ->get();

        $queueOrders = ServiceOrder::where('mitra_id', $mitraId)
            ->whereIn('status', ['waiting', 'in_progress'])
            ->orderBy('queue_number')
            ->get();

        $historyOrders = ServiceOrder::where('mitra_id', $mitraId)
            ->whereIn('status', [
                'done',
                'picked_up',
                'rejected',
                'cancelled',
                'no_show'
            ])
            ->latest()
            ->get();

        // ================= COUNT =================

        $counts = [
            'incoming' => ServiceOrder::where('mitra_id', $mitraId)
                ->whereIn('status', ['pending', 'accepted', 'checked_in'])
                ->count(),

            'queue' => ServiceOrder::where('mitra_id', $mitraId)
                ->whereIn('status', ['waiting', 'in_progress'])
                ->count(),

            'history' => ServiceOrder::where('mitra_id', $mitraId)
                ->whereIn('status', [
                    'done',
                    'picked_up',
                    'rejected',
                    'cancelled',
                    'no_show'
                ])
                ->count(),
        ];

        return view('service-orders.index', compact(
            'pendingOrders',
            'queueOrders',
            'historyOrders',
            'counts'
        ));
    }



    /**
     * Form input servis WALK-IN
     */
    public function createWalkIn()
    {
        $user = Auth::user();

        if (!$user->mitra) {
            abort(403, 'Akun ini belum memiliki mitra');
        }

        return view('service-orders.walk_in_create');
    }

    /**
     * Simpan servis WALK-IN
     */
    public function storeWalkIn(Request $request)
    {
        $user = Auth::user();

        if (!$user->mitra) {
            abort(403, 'Akun ini belum memiliki mitra');
        }

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'vehicle_type_manual' => 'required|string',
            'vehicle_brand_manual' => 'nullable|string',
            'vehicle_model_manual' => 'nullable|string',
            'vehicle_plate_manual' => 'required|string|max:15',
            'customer_complain' => 'nullable|string',
        ]);

        // QUEUE NUMBER (harian, per mitra)
        $todayQueue = ServiceOrder::where('mitra_id', $user->mitra->id)
            ->whereDate('created_at', today())
            ->max('queue_number');

        $queueNumber = $todayQueue ? $todayQueue + 1 : 1;

        ServiceOrder::create([
            'mitra_id' => $user->mitra->id,
            'created_by' => $user->id,
            'order_type' => 'walk_in',

            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,

            'vehicle_type_manual' => $request->vehicle_type_manual,
            'vehicle_brand_manual' => $request->vehicle_brand_manual,
            'vehicle_model_manual' => $request->vehicle_model_manual,
            'vehicle_plate_manual' => $request->vehicle_plate_manual,

            'customer_complain' => $request->customer_complain,

            'queue_number' => $queueNumber,
            'status' => 'waiting',
        ]);

        return redirect()
            ->route('service-orders.index')
            ->with('success', 'Servis walk-in berhasil ditambahkan ke antrian');
    }


    /**
     * ==================================================
     * CREATE ORDER (ONLINE / WALK-IN)
     * ==================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitras,id',
            'order_type' => 'required|in:online,walk_in',

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

            // manual input
            'vehicle_type_manual' => $request->vehicle_type_manual,
            'vehicle_brand_manual' => $request->vehicle_brand_manual,
            'vehicle_model_manual' => $request->vehicle_model_manual,
            'vehicle_plate_manual' => $request->vehicle_plate_manual,

            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_complain' => $request->customer_complain,

            'status' => $request->order_type === 'walk_in'
                ? 'waiting'
                : 'pending',
        ]);

        // WALK-IN → langsung masuk antrian
        if ($order->order_type === 'walk_in') {
            $order->update([
                'queue_number' => $this->generateQueueNumber($order->mitra_id),
                'checked_in_at' => now(),
            ]);
        }

        return back()->with('success', 'Order berhasil dibuat');
    }

    public function show($id)
    {
        $order = ServiceOrder::where('mitra_id', auth()->user()->mitra->id)
            ->findOrFail($id);

        return view('service-orders.show', compact('order'));
    }

    public function downloadPdf($id)
    {
        $order = ServiceOrder::where('mitra_id', auth()->user()->mitra->id)
            ->findOrFail($id);

        $pdf = Pdf::loadView('service-orders.pdf', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('bukti-servis-' . $order->queue_number . '.pdf');
    }


    /**
     * ==================================================
     * ACCEPT / REJECT (BENGKEL)
     * ==================================================
     */
    public function accept(ServiceOrder $serviceOrder)
    {
        if ($serviceOrder->status !== 'pending') {
            return back()->with('error', 'Order tidak valid');
        }

        $serviceOrder->update([
            'status' => 'accepted',
            'accepted_at' => now(),
            'check_in_deadline' => now()->addHour(),
        ]);

        return back()->with('success', 'Booking diterima');
    }

    public function reject(ServiceOrder $serviceOrder)
    {
        if ($serviceOrder->status !== 'pending') {
            return back()->with('error', 'Order tidak valid');
        }

        $serviceOrder->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Booking ditolak');
    }

    /**
     * ==================================================
     * CHECK-IN (QR)
     * ==================================================
     */
    public function checkIn($qrToken)
    {
        $order = ServiceOrder::where('qr_token', $qrToken)->firstOrFail();

        if ($order->status !== 'accepted') {
            return back()->with('error', 'Order tidak bisa check-in');
        }

        // NO SHOW
        if ($order->check_in_deadline && now()->gt($order->check_in_deadline)) {
            $order->update(['status' => 'no_show']);
            return back()->with('error', 'Order sudah no-show');
        }

        $order->update([
            'status' => 'waiting',
            'checked_in_at' => now(),
            'queue_number' => $this->generateQueueNumber($order->mitra_id),
        ]);

        return redirect()
            ->route('service-orders.index')
            ->with('success', 'Check-in berhasil');
    }

    /**
     * ==================================================
     * SERVICE FLOW
     * ==================================================
     */
    public function start(ServiceOrder $serviceOrder)
    {
        if ($serviceOrder->status !== 'waiting') {
            return back()->with('error', 'Servis belum bisa dimulai');
        }

        $serviceOrder->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return back()->with('success', 'Servis dimulai');
    }

    // public function finish(ServiceOrder $serviceOrder)
    // {
    //     if ($serviceOrder->status !== 'in_progress') {
    //         return back()->with('error', 'Servis belum berjalan');
    //     }

    //     $serviceOrder->update([
    //         'status' => 'done',
    //         'finished_at' => now(),
    //     ]);

    //     return back()->with('success', 'Servis selesai');
    // }
    public function finish(Request $request, $id)
    {
        $request->validate([
            'diagnosed_problem' => 'required|string',
            'final_cost' => 'required|numeric|min:0',
        ]);

        $order = ServiceOrder::findOrFail($id);

        $order->update([
            'customer_complain' => $request->customer_complain,
            'diagnosed_problem' => $request->diagnosed_problem,
            'final_cost' => $request->final_cost,
            'status' => 'done',
            'finished_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Servis berhasil diselesaikan');
    }


    public function pickUp(ServiceOrder $serviceOrder)
    {
        if ($serviceOrder->status !== 'done') {
            return back()->with('error', 'Servis belum selesai');
        }

        $serviceOrder->update([
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        return back()->with('success', 'Kendaraan diambil');
    }

    /**
     * ==================================================
     * QUEUE NUMBER GENERATOR (PER HARI & PER BENGKEL)
     * ==================================================
     */
    private function generateQueueNumber($mitraId)
    {
        return ServiceOrder::where('mitra_id', $mitraId)
            ->whereDate('created_at', Carbon::today())
            ->whereNotNull('queue_number')
            ->max('queue_number') + 1;
    }
}

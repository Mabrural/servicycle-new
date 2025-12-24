<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mitra;
use App\Models\ServiceOrder;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function create($slug)
    {
        $mitra = Mitra::where('slug', $slug)->firstOrFail();

        $customer = Customer::where('created_by', Auth::id())->first();

        $vehicles = $customer
            ? Vehicle::where('customer_id', $customer->id)->get()
            : collect();

        return view('booking.create', compact('mitra', 'vehicles'));
    }

    public function store(Request $request, $slug)
    {
        $mitra = Mitra::where('slug', $slug)->firstOrFail();

        $request->validate([
            'customer_complain' => 'required|string|max:255',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        // =============================
        // 🔹 AMBIL CUSTOMER
        // =============================
        $customer = Customer::where('created_by', auth()->id())->first();

        if (!$customer) {
            abort(403, 'Customer profile belum tersedia');
        }

        // =============================
        // 🔹 AMBIL VEHICLE (OPSIONAL)
        // =============================
        $vehicle = null;

        if ($request->vehicle_id) {
            $vehicle = Vehicle::where('id', $request->vehicle_id)
                ->where('customer_id', $customer->id)
                ->first(); // aman, tidak pakai firstOrFail
        }

        // =============================
        // 🔹 SIMPAN SERVICE ORDER
        // =============================
        $serviceOrder = ServiceOrder::create([
            'mitra_id' => $mitra->id,

            // 🔹 CUSTOMER
            'customer_id' => $customer->id,
            'created_by' => auth()->id(),

            // 🔹 VEHICLE RELATION
            'vehicle_id' => $vehicle?->id,

            // 🔹 VEHICLE SNAPSHOT
            'vehicle_type_manual' => $vehicle?->vehicle_type,
            'vehicle_brand_manual' => $vehicle?->brand,
            'vehicle_model_manual' => $vehicle?->model,
            'vehicle_plate_manual' => $vehicle?->plate_number,

            // 🔹 CUSTOMER SNAPSHOT
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,

            'customer_complain' => $request->customer_complain,

            'order_type' => 'online',
            'status' => 'pending',
        ]);

        // =============================
        // 🔹 REDIRECT KE BOOKING SUCCESS
        // =============================
        return redirect()
            ->route('booking.success', $serviceOrder->uuid);

    }
    public function success($uuid)
    {
        $order = ServiceOrder::where('uuid', $uuid)->firstOrFail();

        return view('booking.success', compact('order'));
    }

    public function myOrders()
    {
        $customer = Customer::where('created_by', auth()->id())
            ->firstOrFail();

        return view('booking.my-orders', [

            // MENUNGGU
            'waitingOrders' => ServiceOrder::with('mitra')
                ->where('customer_id', $customer->id)
                ->whereIn('status', [
                    'pending',
                    'accepted',
                    'checked_in'
                ])
                ->latest()
                ->get(),

            // ANTRIAN / PROSES
            'queueOrders' => ServiceOrder::with('mitra')
                ->where('customer_id', $customer->id)
                ->whereIn('status', [
                    'waiting',
                    'in_progress'
                ])
                ->latest()
                ->get(),

            // RIWAYAT
            'historyOrders' => ServiceOrder::with('mitra')
                ->whereIn('status', [
                    'done',
                    'picked_up',
                    'rejected',
                    'cancelled',
                    'no_show'
                ])
                ->where('customer_id', $customer->id)
                ->latest()
                ->get(),
        ]);
    }

    public function cancel(string $uuid)
    {
        $customer = Customer::where('created_by', auth()->id())->firstOrFail();

        $order = ServiceOrder::where('uuid', $uuid)->firstOrFail();

        // Pastikan order milik customer ini
        if ($order->customer_id !== $customer->id) {
            abort(403, 'Akses ditolak');
        }

        // Hanya boleh cancel jika masih pending
        if ($order->status !== 'pending') {
            return back()->with('error', 'Servis tidak bisa dibatalkan');
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Servis berhasil dibatalkan');
    }


    public function track($uuid)
    {
        $order = ServiceOrder::where('uuid', $uuid)->firstOrFail();

        // pastikan order milik user yang login
        // if ($order->created_by !== auth()->id()) {
        //     abort(403, 'Anda tidak berhak mengakses servis ini');
        // }

        return view('booking.track', compact('order'));
    }

    public function buktiServis(Request $request)
    {
        $user = Auth::user();

        // ================= CARI CUSTOMER =================
        $customer = \App\Models\Customer::where('created_by', $user->id)->first();

        if (!$customer) {
            abort(403, 'Akun ini belum terdaftar sebagai customer');
        }

        $customerId = $customer->id;

        // ================= FILTER =================
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $baseQuery = ServiceOrder::where('customer_id', $customerId)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('vehicle_plate_manual', 'like', "%$search%")
                        ->orWhere('vehicle_brand_manual', 'like', "%$search%")
                        ->orWhere('vehicle_model_manual', 'like', "%$search%")
                        ->orWhereHas('mitra', function ($m) use ($search) {
                            $m->where('business_name', 'like', "%$search%");
                        });
                });
            });


        // ================= DATA PER TAB =================

        $historyOrders = (clone $baseQuery)
            ->whereIn('status', [
                'done'
            ])
            ->latest()
            ->paginate($perPage, ['*'], 'history_page');

        // ================= COUNT =================
        $counts = [

            'history' => (clone $baseQuery)
                ->whereIn('status', [
                    'done'
                ])
                ->count(),
        ];

        return view('customer.bukti-servis', compact(
            'historyOrders',
            'counts',
            'perPage',
            'search'
        ));
    }

    public function downloadPdf($id)
    {
        $user = Auth::user();

        // Ambil data customer berdasarkan user login
        $customer = Customer::where('created_by', $user->id)->first();

        if (!$customer) {
            abort(403, 'Akun ini tidak terdaftar sebagai customer');
        }

        // Ambil order MILIK customer tersebut
        $order = ServiceOrder::where('customer_id', $customer->id)
            ->whereIn('status', ['done', 'picked_up']) // opsional: hanya yg selesai
            ->findOrFail($id);

        $pdf = Pdf::loadView('service-orders.pdf', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->download(
            'bukti-servis-' . ($order->queue_number ?? $order->id) . '.pdf'
        );
    }


}

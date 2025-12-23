<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mitra;
use App\Models\ServiceOrder;
use App\Models\Vehicle;
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


    // public function myOrders()
    // {
    //     $customer = Customer::where('created_by', auth()->id())->firstOrFail();

    //     $orders = ServiceOrder::with('mitra')
    //         ->where('customer_id', $customer->id)
    //         ->latest()
    //         ->get();

    //     return view('booking.my-orders', compact('orders'));
    // }

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
                    'accepted'
                ])
                ->latest()
                ->get(),

            // ANTRIAN / PROSES
            'queueOrders' => ServiceOrder::with('mitra')
                ->where('customer_id', $customer->id)
                ->whereIn('status', [
                    'waiting',
                    'checked_in',
                    'in_progress'
                ])
                ->latest()
                ->get(),

            // RIWAYAT
            'historyOrders' => ServiceOrder::with('mitra')
                ->whereIn('status', [
                    'done',
                    'cancelled',
                    'rejected',
                    'no_show'
                ])
                ->where('customer_id', $customer->id)
                ->latest()
                ->get(),
        ]);
    }


    public function track($uuid)
    {
        $order = ServiceOrder::where('uuid', $uuid)->firstOrFail();

        // pastikan order milik user yang login
        if ($order->created_by !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses servis ini');
        }

        return view('booking.track', compact('order'));
    }



    public function qr($uuid)
    {
        $order = ServiceOrder::where('uuid', $uuid)->firstOrFail();

        return response(
            QrCode::driver('gd') // 🔥 PAKSA PAKAI GD
                ->format('png')
                ->size(300)
                ->margin(2)
                ->generate($order->uuid)
        )->header('Content-Type', 'image/png');
    }



}

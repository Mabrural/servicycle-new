<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mitra;
use App\Models\ServiceOrder;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->route('booking.success', $serviceOrder->id);
    }
    public function success(ServiceOrder $order)
    {
        return view('booking.success', compact('order'));
    }

    public function myOrders()
    {
        $customer = Customer::where('created_by', auth()->id())->firstOrFail();

        $orders = ServiceOrder::with('mitra')
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('booking.my-orders', compact('orders'));
    }

    public function track($id)
    {
        $customer = Customer::where('created_by', auth()->id())->firstOrFail();

        $order = ServiceOrder::with('mitra')
            ->where('id', $id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        return view('booking.track', compact('order'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mitra;
use App\Models\ServiceOrder;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    // 🔹 ambil customer dari user login
    $customer = Customer::where('created_by', auth()->id())->first();

    if (!$customer) {
        return back()->withErrors([
            'customer' => 'Customer profile belum tersedia'
        ]);
    }

    $vehicle = null;

    // 🔹 snapshot kendaraan jika dipilih
    if ($request->vehicle_id) {
        $vehicle = Vehicle::where('id', $request->vehicle_id)
            ->where('customer_id', $customer->id)
            ->first();
    }

    $order = ServiceOrder::create([
        'mitra_id'   => $mitra->id,
        'customer_id'=> $customer->id,
        'created_by' => auth()->id(),

        'vehicle_id' => $vehicle?->id,

        // 🔹 snapshot kendaraan (AMAN walau kendaraan dihapus)
        'vehicle_type_manual'  => $vehicle?->vehicle_type,
        'vehicle_brand_manual' => $vehicle?->brand,
        'vehicle_model_manual' => $vehicle?->model,
        'vehicle_plate_manual' => $vehicle?->plate_number,

        'customer_name'  => $customer->name,
        'customer_phone' => $customer->phone,

        'customer_complain' => $request->customer_complain,

        'order_type' => 'online',
        'status'     => 'pending',

        // 🔐 token QR
        'checkin_token' => Str::uuid()
    ]);

    return redirect()
        ->route('booking.success', $order->id);
}
}

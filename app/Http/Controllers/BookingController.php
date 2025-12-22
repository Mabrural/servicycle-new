<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($slug)
    {
        $mitra = Mitra::where('slug', $slug)->firstOrFail();

        return view('booking.create', compact('mitra'));
    }

    public function store(Request $request, $slug)
    {
        $mitra = Mitra::where('slug', $slug)->firstOrFail();

        $request->validate([
            'customer_complain' => 'required|string|max:255',

            // vehicle optional
            'vehicle_id'        => 'nullable|exists:vehicles,id',

            // manual vehicle (fallback)
            'vehicle_type_manual'  => 'nullable|string|max:50',
            'vehicle_brand_manual' => 'nullable|string|max:50',
            'vehicle_model_manual' => 'nullable|string|max:50',
            'vehicle_plate_manual' => 'nullable|string|max:20',
        ]);

        ServiceOrder::create([
            'mitra_id'   => $mitra->id,

            'customer_id'=> auth()->user()->customer->id ?? null,
            'created_by'=> auth()->id(),

            'vehicle_id'=> $request->vehicle_id,

            // manual vehicle
            'vehicle_type_manual'  => $request->vehicle_type_manual,
            'vehicle_brand_manual' => $request->vehicle_brand_manual,
            'vehicle_model_manual' => $request->vehicle_model_manual,
            'vehicle_plate_manual' => $request->vehicle_plate_manual,

            'customer_name'  => auth()->user()->name,
            'customer_phone' => auth()->user()->phone ?? null,

            'customer_complain' => $request->customer_complain,

            'order_type' => 'online',
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Booking servis berhasil dikirim. Menunggu konfirmasi bengkel.');
    }
}

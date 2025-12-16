<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceOrderController extends Controller
{
    public function index()
    {
        $orders = ServiceOrder::with(['mitra', 'customer', 'vehicle'])
            ->latest()
            ->paginate(10);

        return view('service-orders.index', compact('orders'));
    }

    public function create()
    {
        return view('service-orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitras,id',
            'order_type' => 'required|in:online,walk_in',
            'vehicle_plate_manual' => 'required',
            'queue_number' => 'required|integer',
        ]);

        ServiceOrder::create([
            ...$request->all(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('service-orders.index')
            ->with('success', 'Service Order berhasil dibuat.');
    }

    public function show(ServiceOrder $serviceOrder)
    {
        return view('service-orders.show', compact('serviceOrder'));
    }

    public function edit(ServiceOrder $serviceOrder)
    {
        return view('service-orders.edit', compact('serviceOrder'));
    }

    public function update(Request $request, ServiceOrder $serviceOrder)
    {
        $serviceOrder->update($request->all());

        return redirect()->back()->with('success', 'Service Order diperbarui.');
    }

    public function destroy(ServiceOrder $serviceOrder)
    {
        $serviceOrder->delete();

        return redirect()->back()->with('success', 'Service Order dihapus.');
    }
}

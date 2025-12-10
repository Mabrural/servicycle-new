<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Tampilkan semua kendaraan milik customer tertentu.
     */
    // public function index($customerId)
    // {
    //     $customer = Customer::findOrFail($customerId);

    //     // ambil kendaraan milik customer
    //     $vehicles = $customer->vehicles()->latest()->get();

    //     return view('vehicles.index', compact('customer', 'vehicles'));
    // }
    public function index()
{
    $vehicles = Vehicle::orderBy('vehicle_type')->orderBy('brand')->get();
    return view('vehicle.index', compact('vehicles'));
}


    /**
     * Form tambah kendaraan.
     */
    // public function create($customerId)
    // {
    //     $customer = Customer::findOrFail($customerId);

    //     return view('vehicles.create', compact('customer'));
    // }
    public function create(Request $request)
{
    $type = $request->get('type', 'mobil'); // default mobil
    return view('vehicle.create', compact('type'));
}



    /**
     * Simpan kendaraan baru.
     */
    public function store(Request $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);

        $request->validate([
            'vehicle_type' => ['required', 'in:motor,mobil'],
            'brand'        => ['required', 'string'],
            'model'        => ['required', 'string'],
            'tahun'        => ['required', 'digits:4'],
            'plate_number' => ['required', 'string', 'unique:vehicles,plate_number'],
            'kilometer'    => ['nullable', 'integer'],
            'masa_berlaku_stnk' => ['nullable', 'date'],
        ]);

        Vehicle::create([
            'customer_id' => $customer->id,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'plate_number' => strtoupper($request->plate_number),
            'kilometer' => $request->kilometer,
            'masa_berlaku_stnk' => $request->masa_berlaku_stnk,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('vehicles.index', $customer->id)
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }


    /**
     * Form edit kendaraan.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $customer = $vehicle->customer;

        return view('vehicles.edit', compact('vehicle', 'customer'));
    }


    /**
     * Update data kendaraan.
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'vehicle_type' => ['required', 'in:motor,mobil'],
            'brand'        => ['required', 'string'],
            'model'        => ['required', 'string'],
            'tahun'        => ['required', 'digits:4'],
            'plate_number' => ['required', 'string', 'unique:vehicles,plate_number,' . $vehicle->id],
            'kilometer'    => ['nullable', 'integer'],
            'masa_berlaku_stnk' => ['nullable', 'date'],
        ]);

        $vehicle->update([
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'plate_number' => strtoupper($request->plate_number),
            'kilometer' => $request->kilometer,
            'masa_berlaku_stnk' => $request->masa_berlaku_stnk,
        ]);

        return redirect()
            ->route('vehicles.index', $vehicle->customer_id)
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }


    /**
     * Hapus kendaraan.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $customerId = $vehicle->customer_id;

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index', $customerId)
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}

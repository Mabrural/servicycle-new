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
    public function index()
    {
        // Ambil user yang sedang login
        $userId = Auth::id();

        // Cari customer milik user
        $customer = Customer::where('created_by', $userId)->first();

        // Jika user belum punya data customer
        if (!$customer) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan.');
        }

        // Ambil semua kendaraan berdasarkan customer_id
        $vehicles = Vehicle::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('vehicle.index', compact('vehicles'));
    }



    /**
     * Form tambah kendaraan.
     */
    public function create(Request $request)
    {
        $type = $request->get('type', 'mobil'); // default mobil
        return view('vehicle.create', compact('type'));
    }



    /**
     * Simpan kendaraan baru.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $customer = Customer::where('created_by', $userId)->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan.');
        }

        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'tahun' => 'required|integer',
            'plate_number' => 'required',
            'kilometer' => 'required|integer',
            'masa_berlaku_stnk' => 'required|date',
            'vehicle_type' => 'required',
        ]);

        // CEK PLATE NUMBER SUDAH ADA
        if (Vehicle::where('plate_number', $request->plate_number)->exists()) {
            return back()
                ->withInput()
                ->with('error', 'Nomor plat tersebut sudah terdaftar sebelumnya.');
        }

        Vehicle::create([
            'customer_id' => $customer->id,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'plate_number' => $request->plate_number,
            'kilometer' => $request->kilometer,
            'masa_berlaku_stnk' => $request->masa_berlaku_stnk,
            'created_by' => $userId,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Kendaraan berhasil ditambahkan!');
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
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'tahun' => ['required', 'digits:4'],
            'plate_number' => ['required', 'string', 'unique:vehicles,plate_number,' . $vehicle->id],
            'kilometer' => ['nullable', 'integer'],
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
            ->route('vehicle.index', $customerId)
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}

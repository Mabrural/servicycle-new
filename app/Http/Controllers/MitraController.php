<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Ambil data mitra yang terdaftar
        $mitras = Mitra::all();
        ;

        return view('mitra-manajemen.index', compact('mitras'));
    }

    // mitra profile
    public function mitraProfile()
    {
        $id_user = Auth::id();

        $mitras = Mitra::with('coverImage')
            ->where('created_by', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mitra-profile.index', compact('mitras'));
    }


    // edit profil mitra
    public function mitraProfileEdit()
    {
        $id_user = Auth::id();

        // Ambil data mitra yang dibuat oleh user yang login
        $mitra = Mitra::where('created_by', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mitra-profile.edit', compact('mitra'));
    }

    public function mitraProfileUpdate(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $request->validate([
            'business_name' => 'required',
            'address' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'vehicle_type' => 'required|array',

            // Validasi koordinat
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        // Cek apakah business_name berubah
        $slug = $mitra->slug; // default: slug lama

        if ($request->business_name !== $mitra->business_name) {

            // Buat slug baru
            $baseSlug = Str::slug($request->business_name);
            $newSlug = $baseSlug;
            $counter = 1;

            // Cek duplikasi slug
            while (
                Mitra::where('slug', $newSlug)
                    ->where('id', '!=', $mitra->id) // pastikan bukan diri sendiri
                    ->exists()
            ) {
                $newSlug = $baseSlug . '-' . $counter++;
            }

            $slug = $newSlug;
        }

        // Update data
        $mitra->update([
            'business_name' => $request->business_name,
            'slug' => $slug,
            'address' => $request->address,
            'province' => $request->province,
            'regency' => $request->regency,
            'vehicle_type' => $request->vehicle_type,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $id_user = Auth::id();

        $mitra = Mitra::where('created_by', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();
        dd($mitra);
        return view('mitra-profile.edit', compact('mitra'));
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $request->validate([
            'business_name' => 'required',
            'address' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'vehicle_type' => 'required|array',
        ]);

        $mitra->update([
            'business_name' => $request->business_name,
            'address' => $request->address,
            'province' => $request->province,
            'regency' => $request->regency,
            'vehicle_type' => $request->vehicle_type,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        //
    }
}

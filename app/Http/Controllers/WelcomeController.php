<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $lat = $request->lat;
        $lng = $request->lng;
        $vehicle = $request->vehicle ?? 'mobil'; // default mobil

        $query = Mitra::with('coverImage')
            ->where('is_active', true)
            ->whereJsonContains('vehicle_type', $vehicle);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('regency', 'like', "%{$search}%")
                    ->orWhere('province', 'like', "%{$search}%");
            });
        }

        // Jika lokasi tersedia → hitung jarak otomatis
        if ($lat && $lng) {
            $query->select('*')
                ->selectRaw("
                    (6371 * acos(
                        cos(radians(?))
                        * cos(radians(latitude))
                        * cos(radians(longitude) - radians(?))
                        + sin(radians(?))
                        * sin(radians(latitude))
                    )) AS distance
                ", [$lat, $lng, $lat])
                ->orderBy('distance');
        } else {
            $query->latest();
        }

        $mitras = $query->get();

        return view('welcome', compact(
            'mitras',
            'search',
            'lat',
            'lng',
            'vehicle'
        ));
    }
}

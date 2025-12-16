<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $lat = $request->lat;
        $lng = $request->lng;

        $query = Mitra::with('coverImage')
            ->where('is_active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('regency', 'like', "%{$search}%")
                    ->orWhere('province', 'like', "%{$search}%");
            });
        }

        // Jika user share lokasi → hitung jarak
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

        return view('welcome', compact('mitras', 'search', 'lat', 'lng'));
    }
}

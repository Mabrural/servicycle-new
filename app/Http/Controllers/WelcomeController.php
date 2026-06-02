<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $lat = $request->lat;
        $lng = $request->lng;
        $vehicle = $request->vehicle ?? 'mobil';

        $query = Mitra::with('coverImage')
            ->withCount([
                'serviceOrders as antrian_count' => function ($q) {
                    $q->whereIn('status', ['waiting', 'in_progress']);
                }
            ])
            ->where('is_active', true)
            ->whereJsonContains('vehicle_type', $vehicle);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('regency', 'like', "%{$search}%")
                    ->orWhere('province', 'like', "%{$search}%");
            });
        }

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

        $antrianPerMitra = ServiceOrder::whereIn('status', ['waiting', 'in_progress'])
            ->selectRaw('mitra_id, COUNT(*) as total')
            ->groupBy('mitra_id')
            ->pluck('total', 'mitra_id');

        $mitras->each(function ($mitra) use ($antrianPerMitra) {
            $mitra->antrian_count = $antrianPerMitra[$mitra->id] ?? 0;
        });
        
        return view('welcome', compact(
            'mitras',
            'search',
            'lat',
            'lng',
            'vehicle'
        ));
    }
}

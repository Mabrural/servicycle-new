<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBengkelController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // default tanggal (bulan ini)
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end   = $request->end_date ?? now()->endOfMonth()->toDateString();

        $orders = ServiceOrder::where('mitra_id', $user->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        // Statistik
        $stats = [
            'total'       => $orders->count(),
            'checked_in'  => $orders->where('status', 'checked_in')->count(),
            'in_progress' => $orders->where('status', 'in_progress')->count(),
            'done'        => $orders->where('status', 'done')->count(),
            'cancelled'   => $orders->where('status', 'cancelled')->count(),
            'no_show'     => $orders->where('status', 'no_show')->count(),
        ];

        // Grafik servis per hari
        $chart = $orders
            ->groupBy(fn ($o) => $o->created_at->format('Y-m-d'))
            ->map(fn ($row) => $row->count());

        return view('laporan.index', compact(
            'orders',
            'stats',
            'chart',
            'start',
            'end'
        ));
    }

    public function pdf(Request $request)
    {
        $user = Auth::user();

        $start = $request->start_date;
        $end   = $request->end_date;

        $orders = ServiceOrder::where('mitra_id', $user->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $stats = [
            'total' => $orders->count(),
            'done'  => $orders->where('status', 'done')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
            'no_show' => $orders->where('status', 'no_show')->count(),
        ];

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'orders',
            'stats',
            'start',
            'end',
            'user'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('laporan-bengkel.pdf');
    }
}

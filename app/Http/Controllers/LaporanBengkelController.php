<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBengkelController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Cari mitra berdasarkan user yang login
        $mitra = Mitra::where('created_by', $user->id)->first();

        if (!$mitra) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai mitra.');
        }

        // default tanggal (bulan ini)
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->endOfMonth()->toDateString();

        // Query dengan mitra_id yang benar
        $orders = ServiceOrder::where('mitra_id', $mitra->id)
            ->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik
        $stats = [
            'total'       => $orders->count(),
            'pending'     => $orders->where('status', 'pending')->count(),
            'accepted'    => $orders->where('status', 'accepted')->count(),
            'rejected'    => $orders->where('status', 'rejected')->count(),
            'checked_in'  => $orders->where('status', 'checked_in')->count(),
            'waiting'     => $orders->where('status', 'waiting')->count(),
            'in_progress' => $orders->where('status', 'in_progress')->count(),
            'done'        => $orders->where('status', 'done')->count(),
            'picked_up'   => $orders->where('status', 'picked_up')->count(),
            'no_show'     => $orders->where('status', 'no_show')->count(),
            'cancelled'   => $orders->where('status', 'cancelled')->count(),
        ];

        // Grafik servis per hari
        $chart = $orders
            ->groupBy(fn($o) => $o->created_at->format('Y-m-d'))
            ->map(fn($row) => $row->count())
            ->sortKeys();

        return view('laporan.index', compact(
            'orders',
            'stats',
            'chart',
            'start',
            'end',
            'mitra'
        ));
    }

    public function pdf(Request $request)
    {
        $user = Auth::user();

        // Cari mitra berdasarkan user yang login
        $mitra = Mitra::where('created_by', $user->id)->first();

        if (!$mitra) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai mitra.');
        }

        $start = $request->start_date;
        $end = $request->end_date;

        // Validasi tanggal
        if (!$start || !$end) {
            $start = now()->startOfMonth()->toDateString();
            $end = now()->endOfMonth()->toDateString();
        }

        $orders = ServiceOrder::where('mitra_id', $mitra->id)
            ->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total'       => $orders->count(),
            'pending'     => $orders->where('status', 'pending')->count(),
            'accepted'    => $orders->where('status', 'accepted')->count(),
            'rejected'    => $orders->where('status', 'rejected')->count(),
            'checked_in'  => $orders->where('status', 'checked_in')->count(),
            'waiting'     => $orders->where('status', 'waiting')->count(),
            'in_progress' => $orders->where('status', 'in_progress')->count(),
            'done'        => $orders->where('status', 'done')->count(),
            'picked_up'   => $orders->where('status', 'picked_up')->count(),
            'no_show'     => $orders->where('status', 'no_show')->count(),
            'cancelled'   => $orders->where('status', 'cancelled')->count(),
        ];

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'orders',
            'stats',
            'start',
            'end',
            'mitra'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('laporan-bengkel-' . $mitra->slug . '.pdf');
    }
}
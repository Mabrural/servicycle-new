<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];
        $showAlert = false;
        $mitra = null;

        if ($user->role === 'mitra') {
            $mitra = Mitra::where('created_by', $user->id)->first();

            if ($mitra && $mitra->is_active == false) {
                $showAlert = true;
            }

            // Data untuk mitra
            $data = $this->getMitraDashboardData($mitra);

        } elseif ($user->role === 'admin') {
            // Data untuk admin
            $data = $this->getAdminDashboardData();

        } elseif ($user->role === 'customer') {
            // Data untuk customer
            $data = $this->getCustomerDashboardData($user);
        }

        return view('dashboard', compact('mitra', 'showAlert', 'data'));
    }

    private function getMitraDashboardData($mitra)
    {
        if (!$mitra) {
            return [];
        }

        // Total order
        $totalOrders = ServiceOrder::where('mitra_id', $mitra->id)->count();

        // Order hari ini
        $todayOrders = ServiceOrder::where('mitra_id', $mitra->id)
            ->whereDate('created_at', today())
            ->count();

        // Order pending
        $pendingOrders = ServiceOrder::where('mitra_id', $mitra->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->count();

        // Order selesai bulan ini
        $completedOrders = ServiceOrder::where('mitra_id', $mitra->id)
            ->where('status', 'done')
            ->whereMonth('created_at', now()->month)
            ->count();

        // Pendapatan bulan ini
        $monthlyRevenue = ServiceOrder::where('mitra_id', $mitra->id)
            ->where('status', 'done')
            ->whereMonth('created_at', now()->month)
            ->sum('final_cost') ?? 0;

        // Order berdasarkan status
        $ordersByStatus = ServiceOrder::where('mitra_id', $mitra->id)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Order 7 hari terakhir
        $last7DaysOrders = ServiceOrder::where('mitra_id', $mitra->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Order hari ini untuk antrian
        $todayQueue = ServiceOrder::where('mitra_id', $mitra->id)
            ->whereDate('created_at', today())
            ->whereIn('status', ['waiting', 'in_progress'])
            ->orderBy('queue_number')
            ->get();

        return [
            'totalOrders' => $totalOrders,
            'todayOrders' => $todayOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'monthlyRevenue' => $monthlyRevenue,
            'ordersByStatus' => $ordersByStatus,
            'last7DaysOrders' => $last7DaysOrders,
            'todayQueue' => $todayQueue,
        ];
    }

    private function getAdminDashboardData()
    {
        // Total mitra
        $totalMitra = Mitra::count();

        // Total mitra aktif
        $activeMitra = Mitra::where('is_active', true)->count();

        // Total customer
        $totalCustomer = Customer::count();

        // Total order
        $totalOrders = ServiceOrder::count();

        // Total pendapatan
        $totalRevenue = ServiceOrder::where('status', 'done')->sum('final_cost') ?? 0;

        // Pendapatan bulan ini
        $monthlyRevenue = ServiceOrder::where('status', 'done')
            ->whereMonth('created_at', now()->month)
            ->sum('final_cost') ?? 0;

        // User baru bulan ini
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();

        // Mitra baru bulan ini
        $newMitraThisMonth = Mitra::whereMonth('created_at', now()->month)->count();

        // Order berdasarkan status
        $ordersByStatus = ServiceOrder::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Order 30 hari terakhir
        $last30DaysOrders = ServiceOrder::where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Mitra dengan order terbanyak
        $topMitras = ServiceOrder::select('mitras.business_name', DB::raw('count(service_orders.id) as total_orders'))
            ->join('mitras', 'mitras.id', '=', 'service_orders.mitra_id')
            ->groupBy('mitras.id', 'mitras.business_name')
            ->orderBy('total_orders', 'desc')
            ->limit(5)
            ->get();

        return [
            'totalMitra' => $totalMitra,
            'activeMitra' => $activeMitra,
            'totalCustomer' => $totalCustomer,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'monthlyRevenue' => $monthlyRevenue,
            'newUsersThisMonth' => $newUsersThisMonth,
            'newMitraThisMonth' => $newMitraThisMonth,
            'ordersByStatus' => $ordersByStatus,
            'last30DaysOrders' => $last30DaysOrders,
            'topMitras' => $topMitras,
        ];
    }

    private function getCustomerDashboardData($user)
    {
        // Data customer
        $customer = Customer::where('email', $user->email)->first();

        if (!$customer) {
            return [];
        }

        // Total kendaraan
        $totalVehicles = Vehicle::where('customer_id', $customer->id)->count();

        // Total order
        $totalOrders = ServiceOrder::where('customer_id', $customer->id)->count();

        // Order aktif (pending/accepted/waiting/in_progress)
        $activeOrders = ServiceOrder::where('customer_id', $customer->id)
            ->whereIn('status', ['pending', 'accepted', 'waiting', 'in_progress'])
            ->count();

        // Order selesai
        $completedOrders = ServiceOrder::where('customer_id', $customer->id)
            ->where('status', 'done')
            ->count();

        // Total pengeluaran
        $totalSpent = ServiceOrder::where('customer_id', $customer->id)
            ->where('status', 'done')
            ->sum('final_cost') ?? 0;

        // Order terbaru
        $recentOrders = ServiceOrder::where('customer_id', $customer->id)
            ->with('mitra')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Kendaraan
        $vehicles = Vehicle::where('customer_id', $customer->id)->get();

        // Order berdasarkan status
        $ordersByStatus = ServiceOrder::where('customer_id', $customer->id)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return [
            'customer' => $customer,
            'totalVehicles' => $totalVehicles,
            'totalOrders' => $totalOrders,
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
            'totalSpent' => $totalSpent,
            'recentOrders' => $recentOrders,
            'vehicles' => $vehicles,
            'ordersByStatus' => $ordersByStatus,
        ];
    }
}
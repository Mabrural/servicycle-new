<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Default: tidak tampilkan alert
        $showAlert = false;
        $mitra = null;

        // Jika role adalah mitra, lakukan pengecekan
        if ($user->role === 'mitra') {

            // Ambil data mitra
            $mitra = Mitra::where('created_by', $user->id)->first();

            // Jika data mitra ada dan belum aktif, tampilkan alert
            if ($mitra && $mitra->is_active == false) {
                $showAlert = true;
            }
        }

        return view('dashboard', compact('mitra', 'showAlert'));
    }


}

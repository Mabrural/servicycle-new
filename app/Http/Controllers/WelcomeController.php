<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $mitras = Mitra::with(['coverImage'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('mitras'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class BengkelController extends Controller
{
    public function show($slug)
    {
        $mitra = Mitra::with(['coverImage'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('bengkel.show', compact('mitra'));
    }
}

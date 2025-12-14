<?php

namespace App\Http\Controllers;

use App\Models\MitraImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mitra_id'   => 'required|exists:mitras,id',
            'image_path' => 'required|string',
            'is_cover'   => 'boolean',
            'sort_order' => 'integer',
        ]);

        // jika is_cover true, set cover lain menjadi false
        if ($request->is_cover) {
            MitraImage::where('mitra_id', $request->mitra_id)
                ->update(['is_cover' => false]);
        }

        MitraImage::create([
            'mitra_id'   => $request->mitra_id,
            'image_path' => $request->image_path,
            'is_cover'   => $request->is_cover ?? false,
            'sort_order' => $request->sort_order ?? 0,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Gambar mitra berhasil ditambahkan');
    }

    public function destroy(MitraImage $mitraImage)
    {
        $mitraImage->delete();

        return back()->with('success', 'Gambar mitra berhasil dihapus');
    }
}

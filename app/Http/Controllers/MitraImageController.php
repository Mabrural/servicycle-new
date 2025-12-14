<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\MitraImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MitraImageController extends Controller
{
    /**
     * Upload image ke SLOT tertentu
     */
    public function store(Request $request, Mitra $mitra)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'slot' => 'required|integer|min:0|max:4',
        ]);

        $slot = (int) $request->slot;

        // Cek apakah slot sudah terisi
        $existing = $mitra->images()
            ->where('sort_order', $slot)
            ->first();

        // Kalau slot sudah ada → replace (hapus lama)
        if ($existing) {
            Storage::disk('public')->delete($existing->image_path);
            $existing->delete();
        }

        // Upload baru
        $path = $request->file('image')->store('mitra-images', 'public');

        $image = MitraImage::create([
            'mitra_id' => $mitra->id,
            'image_path' => $path,
            'sort_order' => $slot,
            'is_cover' => $slot === 0, // cover hanya slot 0
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'id' => $image->id,
            'url' => asset('storage/' . $path),
            'slot' => $slot,
        ]);
    }

    /**
     * Hapus image TANPA GESER SLOT
     */
    public function destroy(MitraImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $slot = $image->sort_order;
        $image->delete();

        return response()->json([
            'success' => true,
            'slot' => $slot,
        ]);
    }
}

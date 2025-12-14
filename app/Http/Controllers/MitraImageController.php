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
     * Upload image (AJAX)
     */
    public function store(Request $request, Mitra $mitra)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'is_cover' => 'nullable|boolean',
        ]);

        // Batas maksimal 5 gambar
        if ($mitra->images()->count() >= 5) {
            return response()->json([
                'message' => 'Maksimal 5 gambar'
            ], 422);
        }

        // Jika cover → reset cover sebelumnya
        if ($request->boolean('is_cover')) {
            $mitra->images()->update(['is_cover' => false]);
        }

        // Upload file
        $path = $request->file('image')->store('mitra-images', 'public');

        $image = MitraImage::create([
            'mitra_id' => $mitra->id,
            'image_path' => $path,
            'is_cover' => $request->boolean('is_cover'),
            'sort_order' => $mitra->images()->count(),
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'id' => $image->id,
            'url' => asset('storage/' . $path),
            'is_cover' => $image->is_cover,
        ]);
    }

    /**
     * Hapus image
     */
    public function destroy(MitraImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Set cover image
     */
    public function setCover(MitraImage $image)
    {
        MitraImage::where('mitra_id', $image->mitra_id)
            ->update(['is_cover' => false]);

        $image->update(['is_cover' => true]);

        return response()->json(['success' => true]);
    }
}

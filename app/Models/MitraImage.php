<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'mitra_id',
        'image_path',
        'is_cover',
        'sort_order',
        'created_by',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    /* ================= RELATIONS ================= */

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    // relasi ke users dengan nama creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

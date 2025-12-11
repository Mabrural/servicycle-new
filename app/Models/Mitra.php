<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'vehicle_type',
        'province',
        'regency',
        'address',
        'latitude',
        'longitude',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'vehicle_type' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Relasi ke user pembuat
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

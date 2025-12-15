<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'slug',
        'business_name',
        'vehicle_type',
        'province',
        'regency',
        'address',
        'description',
        'services',
        'operational_hours',
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
        'services' => 'array',
        'operational_hours' => 'array',
    ];

    // Relasi ke user pembuat
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function images()
    {
        return $this->hasMany(MitraImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(MitraImage::class)->where('is_cover', true);
    }

}

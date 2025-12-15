<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

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
        'payment_method',
        'facilities',
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
        'payment_method' => 'array',
        'facilities' => 'array',
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

    public function isOpenNow(): bool
    {
        if (!$this->operational_hours)
            return false;

        $now = now();
        $dayKey = strtolower($now->format('l')); // monday, tuesday

        $today = $this->operational_hours[$dayKey] ?? null;

        if (!$today || empty($today['open']))
            return false;

        if (empty($today['start']) || empty($today['end']))
            return false;

        $start = Carbon::createFromTimeString($today['start']);
        $end = Carbon::createFromTimeString($today['end']);

        return $now->between($start, $end);
    }

    public function isProfileIncomplete(): bool
    {
        // basic info
        if (
            empty($this->business_name) ||
            empty($this->address) ||
            empty($this->province) ||
            empty($this->regency)
        ) {
            return true;
        }

        // location
        if (empty($this->latitude) || empty($this->longitude)) {
            return true;
        }

        // cover image wajib
        if (!$this->coverImage) {
            return true;
        }

        // services
        if (empty($this->services) || count($this->services) === 0) {
            return true;
        }

        // payment method
        if (empty($this->payment_method) || count($this->payment_method) === 0) {
            return true;
        }

        // facilities
        if (empty($this->facilities) || count($this->facilities) === 0) {
            return true;
        }

        // operational hours → minimal ada 1 hari buka valid
        if (!$this->hasValidOperationalHours()) {
            return true;
        }

        return false;
    }

    public function hasValidOperationalHours(): bool
    {
        if (empty($this->operational_hours)) {
            return false;
        }

        foreach ($this->operational_hours as $day) {
            if (
                !empty($day['open']) &&
                !empty($day['start']) &&
                !empty($day['end'])
            ) {
                return true;
            }
        }

        return false;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_type',
        'brand',
        'model',
        'tahun',
        'plate_number',
        'kilometer',
        'masa_berlaku_stnk',
        'created_by',
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi ke User (yang membuat data kendaraan)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

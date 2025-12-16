<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'mitra_id',
        'customer_id',
        'vehicle_id',
        'created_by',
        'order_type',
        'vehicle_type_manual',
        'vehicle_brand_manual',
        'vehicle_model_manual',
        'vehicle_plate_manual',
        'customer_name',
        'customer_phone',
        'customer_complain',
        'diagnosed_problem',
        'estimated_cost',
        'final_cost',
        'queue_number',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /* ================= RELATIONS ================= */

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

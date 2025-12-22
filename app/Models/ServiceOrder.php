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

        // manual vehicle input
        'vehicle_type_manual',
        'vehicle_brand_manual',
        'vehicle_model_manual',
        'vehicle_model_manual',
        'vehicle_plate_manual',

        // customer & service
        'customer_name',
        'customer_phone',
        'customer_complain',
        'diagnosed_problem',

        // cost
        'estimated_cost',
        'final_cost',

        // queue & status
        'queue_number',
        'status',

        // check-in & QR
        'qr_token',
        'checked_in_at',
        'check_in_deadline',

        // service timeline
        'accepted_at',
        'started_at',
        'finished_at',
        'picked_up_at',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'accepted_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'check_in_deadline' => 'datetime',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'picked_up_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = $model->uuid ?? Str::uuid();
            $model->qr_token = $model->qr_token ?? Str::uuid();
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

    /* ================= SCOPES ================= */

    public function scopeActiveQueue($query)
    {
        return $query->whereIn('status', ['waiting', 'in_progress']);
    }

    public function scopeOnline($query)
    {
        return $query->where('order_type', 'online');
    }

    public function scopeWalkIn($query)
    {
        return $query->where('order_type', 'walk_in');
    }
}

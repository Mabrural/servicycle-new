<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCoupon extends Model
{
    protected $fillable = [
        'code',
        'role',
        'discount',
        'is_lifetime',
        'max_usage',
        'used_count',
        'expired_at'
    ];

    protected $casts = [
        'is_lifetime' => 'boolean',
        'expired_at' => 'date'
    ];

    public function isValid()
    {
        if ($this->expired_at && $this->expired_at->isPast())
            return false;
        if ($this->max_usage && $this->used_count >= $this->max_usage)
            return false;
        return true;
    }
}

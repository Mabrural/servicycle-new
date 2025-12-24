<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'is_pro',
        'start_at',
        'end_at',
        'is_lifetime',
        'price',
        'discount',
        'notes'
    ];

    protected $casts = [
        'is_pro' => 'boolean',
        'is_lifetime' => 'boolean',
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        if ($this->is_lifetime) return true;
        if (!$this->is_pro) return false;
        return $this->end_at && $this->end_at->isFuture();
    }
}

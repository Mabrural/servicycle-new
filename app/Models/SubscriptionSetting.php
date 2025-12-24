<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionSetting extends Model
{
    protected $fillable = [
        'is_enabled',
        'customer_price',
        'mitra_price'
    ];
}

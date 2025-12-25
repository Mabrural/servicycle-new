<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'reference',
        'merchant_ref',
        'payment_method',
        'amount',
        'discount',
        'status',
        'checkout_url',
        'payload'
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}

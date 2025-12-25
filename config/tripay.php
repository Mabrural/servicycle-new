<?php

return [
    'api_key' => env('TRIPAY_API_KEY'),
    'private_key' => env('TRIPAY_PRIVATE_KEY'),
    'merchant_code' => env('TRIPAY_MERCHANT_CODE'),
    'sandbox' => env('TRIPAY_SANDBOX', true),
    'callback_url' => env('TRIPAY_CALLBACK_URL'),

    'base_url' => env('TRIPAY_SANDBOX', true)
        ? 'https://tripay.co.id/api-sandbox'
        : 'https://tripay.co.id/api',
];

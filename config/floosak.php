<?php

return [
    'auth' => [
        'phone' => env('FLOOSAK_MERCHANT_PHONE'),
        'short_code' => env('FLOOSAK_MERCHANT_SHORT_CODE'),
        'wallet_id' => env('FLOOSAK_MERCHANT_WALLET_ID'),
        'key' => env('FLOOSAK_MERCHANT_KEY'),
    ],
    'url' => [
        'base' => env('FLOOSAK_BASE_URL', 'https://staging.fintech-expert.net'),
    ]
];

<?php

return [
    'auth' => [
        'phone' => env('FLOOSAK_MERCHANT_PHONE'),
        'short_code' => env('FLOOSAK_MERCHANT_SHORT_CODE'),
        'request_id' => env('FLOOSAK_MERCHANT_REQUEST_ID'),
        'key' => env('FLOOSAK_MERCHANT_KEY'),
    ],
    'url' => [
        'base' => env('FLOOSAK_BASE_URL', 'https://staging.qchosts.com'),
    ]
];

# floosak-payment 
laravel package for floosak payment getway


install the package
`composer require alsharie/floosak-payment`


You can publish using the following command

`php artisan vendor:publish --provider="Alsharie\FloosakPayment\FloosakServiceProvider"`

When published, the `config/floosak.php` config file contains:



```php
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
```

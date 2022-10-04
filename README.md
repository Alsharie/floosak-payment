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

***If you don't have the request_id and key you must do the following:***

### 1. get request Id

```php
 $floosak = new Floosak();
 $response = $floosak->requestKey();

 if ($response->isSuccess()) {
    $request_id = $response->getRequestId();
    ....
    ....
 } 
        
```

### 2. verify request Id

after getting the response ***YOU MUST*** store `key`,`request_id` in `config/floosak.php` or in your `.env`

```php
$floosak = new Floosak();
$response = $floosak
    ->setOtp(/*otp*/)
    ->setRequestId(/*requestId*/) 
    ->verifyKey();

if ($response->isSuccess()) {
    $key= $response->getKey();
    $request_id= $response->getRequestId();
    //todo:: store $key and $request_id
    
} else {

    return $response->body();
}  
```

------------------------
To purchase using Floosak payment

### 1. Purchase

```php
 $floosak = new Floosak();
 $response = $floosak
     ->setRefId(/*ref_id*/) // random number you generate most 
     ->setAmount(/*amount*/)
     ->setCustomerPhone(/*phone*/)
     ->purchase();

 if ($response->isSuccess()) {
    $purchase_id = $response->getPurchaseId();
    ....
    ....
 } 
        
```

### 2. Confirm purchase

```php
 $floosak = new Floosak();
 $response = $floosak
     ->setRefId(/*ref_id*/) // the random number you generated  
     ->setAmount(/*amount*/)
     ->setCustomerPhone(/*phone*/)
     ->purchase();
 $response = $floosak
      ->setRefId(/*ref_id*/) // the number you generated in above request
      ->setOtp(/*user_otp*/)
      ->setPurchaseId(/*purchase_id*/) // you get it from the response of the above request `purchase()`
      ->confirmPurchase();
 if ($response->isSuccess()) {
    $tran_id = $response->getTransactionId();
    ....
    ....
 } 
        
```

-----------
### Check purchase status

```php
 $floosak = new Floosak();
 $response = $floosak
     ->setRefId(/*ref_id*/) // the random number you generated  
     ->setTransactionId(/*tran_id*/)
     ->checkPurchaseStatus();

 if ($response->isSuccess()) {
     return $response->getStatus();
 }

```


you can get the full **response body** using `$response->body()` for all requests
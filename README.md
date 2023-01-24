# floosak-payment
![img.png](img.png)

laravel package for floosak payment getway

Floosak payment api after update to (p2mcl)

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
        'wallet_id' => env('FLOOSAK_MERCHANT_WALLET_ID'),
        'key' => env('FLOOSAK_MERCHANT_KEY'),
    ],
    'url' => [
        'base' => env('FLOOSAK_BASE_URL', 'https://staging.fintech-expert.net'),
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
    $wallet_id= $response->getWalletId();
    //todo:: store $key and $wallet_id
    
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
     ->setRequestId(/*ref_id*/) // random number you generate most 
     ->setAmount(/*amount*/)
     ->setCustomerPhone(/*phone*/)
     ->setPurpose(/*purpose*/)
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
      ->setPurchaseId(/*purchase_id*/) // you get it from the response of the above request `purchase()`
      ->setOtp(/*user_otp*/)
      ->confirmPurchase();
 if ($response->isSuccess()) {
    $tran_id = $response->getTransactionId();
    ....
    ....
 } 
        
```


--------------
### Refund

```php
 $floosak = new Floosak();
 $response = $floosak
     ->setRequestId(/*ref_id*/) // the random number you generated  
     ->setTransactionId(/*tran_id*/)
     ->setAmount(/*amount*/) // amount to refund
     ->refund();

 if ($response->isSuccess()) {
     return $response->getBalance();
 }

```

you can get the full **response body** using `$response->body()` for all requests
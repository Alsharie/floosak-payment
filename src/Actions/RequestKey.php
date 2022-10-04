<?php

namespace Alsharie\FloosakPayment\Actions;


use Exception;

class RequestKey extends Guzzle
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Request method.
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * Store request attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * This field contains any random number you generate
     * @return $this
     */
    public function setRefId($refId): Floosak
    {
        $this->attributes['ref_id'] = $refId;
        return $this;
    }

    /**
     * This field contains id of product purchase which customer
     * want to pay for it.
     * You got from purchase request AP
     * @return $this
     */
    public function setPurchaseId($purchaseId): Floosak
    {
        $this->attributes['purchase_id'] = $purchaseId;
        return $this;
    }

    /**
     * This field contains id of transaction you will use to refund
     * amount to customer or check status payment process.
     * @return $this
     */
    public function setTransactionId($transactionId): Floosak
    {
        $this->attributes['transaction_id'] = $transactionId;
        return $this;
    }

    /**
     * t’s 6 digit and unique we sent it to customer phone via SMS
     * when you use purchase request API.
     * @return $this
     */
    public function setOtp($otp): Floosak
    {
        $this->attributes['otp'] = $otp;
        return $this;
    }

    /**
     * @return $this
     */
    public function setCustomerPhone($phone)
    {
        $this->attributes['customer_phone'] = $phone;
        return $this;
    }


    /**
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->attributes['amount'] = $amount;
        return $this;
    }



    /**
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function mergeAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param mixed $key
     *
     * @return boolean
     */
    public function hasAttribute($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * @param mixed $key
     *
     * @return Floosak
     */
    public function removeAttribute($key)
    {
        $this->attributes = array_filter($this->attributes, function ($name) use ($key) {
            return $name !== $key;
        }, ARRAY_FILTER_USE_KEY);

        return $this;
    }

    /**
     * @return FloosakResponse
     * @throws Exception
     */
    public function pay()
    {
        // set `terminal_id`, and `password` .
        $this->setAuthAttributes();

        // generate request
        $this->generateRequestHash();

        // set setMerchantIp if not set
        $this->_setMerchantIp();

        try {
            $response = $this->guzzleClient->request(
                $this->method,
                $this->getEndPointPath(),
                [
                    'json' => $this->attributes,
                ]
            );

            return new FloosakResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $transaction_id
     * @return mixed
     * @throws Exception
     */
    public function verify(string $transaction_id)
    {
        // set `terminal_id`, and `password` now.
        $this->setAuthAttributes();

        // As requestHas for paying request is different from requestHash for find request.
        $this->generateFindRequestHash();

        // set setMerchantIp if not set
        $this->_setMerchantIp();

        $this->attributes['transid'] = $transaction_id;

        try {
            $response = $this->guzzleClient->request(
                $this->method,
                $this->getEndPointPath(),
                [
                    'json' => $this->attributes,
                ]
            );

            return new FloosakResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return void
     */
    protected function generateRequestHash()
    {
        $this->generateHash();
        $this->attributes['action'] = '1'; // action is always 1
    }

    /**
     * Security Check API For transaction performed authorization
     * @return void
     */
    protected function generateFindRequestHash()
    {
        $this->generateHash();
        $this->attributes['action'] = '10'; // action is always 1
    }

    /**
     * @return void
     */
    protected function setAuthAttributes()
    {
        $this->attributes['phone'] = config('floosak.auth.phone');
        $this->attributes['short_code'] = config('floosak.auth.short_code');
        $this->attributes['required_id'] = config('floosak.auth.required_id');
        $this->attributes['key'] = config('floosak.auth.key');
    }

    /**
     *
     * Create SHA256 Hash with below mention Parameters.Merchant needs to form the below hash sequence before posting the transaction to floosak.
     * Below is the SHA 256 Hash creation format :
     * Hash Sequence :- trackid|Terminalid|password|secret_key|amount|currency_code
     * Note : Terminalid, password, secret_key will be provided by Floosak
     *
     * @return void
     */
    protected function generateHash(): void
    {

        $requestHash = $this->attributes['trackid'] . '|' . config('floosak.auth.terminal_id') . '|' . config('floosak.auth.password') . '|' . config('floosak.auth.merchant_key') . '|' . $this->attributes['amount'] . '|' . $this->attributes['currency'];
        $this->attributes['requestHash'] = hash('sha256', $requestHash);
    }

    /**
     * return the server ip address
     * @return mixed|string
     * @throws Exception
     */
    protected function _getServerIP()
    {
        $ip_address = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        } else if (isset($_SERVER['SERVER_ADDR'])) {
            $ip_address = $_SERVER['SERVER_ADDR'];
        } else {
            throw new Exception('Unable to get server ip address');
        }

        return $ip_address;
    }


    /**
     * set setMerchantIp attribute if not set
     * @return void
     */
    protected function _setMerchantIp()
    {
        if (!$this->hasAttribute('merchantIp')) {
            $this->attributes['merchantIp'] = $this->_getServerIP();
        }
    }
}
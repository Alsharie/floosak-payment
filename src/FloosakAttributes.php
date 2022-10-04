<?php

namespace Alsharie\FloosakPayment;


class FloosakAttributes extends Guzzle
{

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
    public function setRequestId($requestId): Floosak
    {
        $this->attributes['request_id'] = $requestId;
        return $this;
    }

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
     * @param $transactionId
     * @return FloosakAttributes
     */
    public function setTransactionId($transactionId): FloosakAttributes
    {
        $this->attributes['transaction_id'] = $transactionId;
        return $this;
    }

    /**
     * t’s 6 digit and unique we sent it to customer phone via SMS
     * when you use purchase request API.
     * @param $otp
     * @return FloosakAttributes
     */
    public function setOtp($otp): FloosakAttributes
    {
        $this->attributes['otp'] = $otp;
        return $this;
    }

    /**
     * @return $this
     */
    public function setCustomerPhone($phone): FloosakAttributes
    {
        $this->attributes['customer_phone'] = $phone;
        return $this;
    }


    /**
     * @return $this
     */
    public function setAmount($amount): FloosakAttributes
    {
        $this->attributes['amount'] = $amount;
        return $this;
    }


    /**
     * @return $this
     */
    public function setAttributes(array $attributes): FloosakAttributes
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function mergeAttributes(array $attributes): FloosakAttributes
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
    public function setAttribute($key, $value): FloosakAttributes
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param mixed $key
     *
     * @return boolean
     */
    public function hasAttribute($key): bool
    {
        return isset($this->attributes[$key]);
    }

    /**
     * @param mixed $key
     *
     * @return FloosakAttributes
     */
    public function removeAttribute($key): FloosakAttributes
    {
        $this->attributes = array_filter($this->attributes, function ($name) use ($key) {
            return $name !== $key;
        }, ARRAY_FILTER_USE_KEY);

        return $this;
    }


    /**
     * @return void
     */
    protected function setAuthAttributes()
    {
        $this->attributes['phone'] = config('floosak.auth.phone');
        $this->attributes['short_code'] = config('floosak.auth.short_code');
    }


    /**
     * @return void
     */
    protected function setMerchantKeyAttributes()
    {
        $this->attributes['request_id'] = config('floosak.auth.request_id');
        $this->attributes['key'] = config('floosak.auth.key');
    }


}
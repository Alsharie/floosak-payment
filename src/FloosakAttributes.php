<?php

namespace Alsharie\FloosakPayment;


use Alsharie\JawaliPayment\Helpers\JawaliAuthHelper;

class FloosakAttributes extends Guzzle
{

    /**
     * Store request attributes.
     */
    protected array $attributes = [];

    protected array $headers = [];

    /**
     * his field contains merchant request id for all process. It’s unique you got from request key
     * @param $requestId
     * @return FloosakAttributes
     */
    public function setRequestId($requestId): FloosakAttributes
    {
        $this->attributes['request_id'] = $requestId;
        return $this;
    }

    /**
     * This field contains any random number you generate
     * @param $refId
     * @return FloosakAttributes
     */
    public function setRefId($refId): FloosakAttributes
    {
        $this->attributes['ref_id'] = $refId;
        return $this;
    }


    /**
     * This field contains any random number you generate
     * used in [Balance Enquiry] request
     * @param $reqId
     * @return FloosakAttributes
     */
    public function setReqId($reqId): FloosakAttributes
    {
        $this->attributes['req_id'] = $reqId;
        return $this;
    }

    /**
     * This field contains id of product purchase which customer
     * want to pay for it.
     * You got from [purchase request] API
     * @param $purchaseId
     * @return FloosakAttributes
     */
    public function setPurchaseId($purchaseId): FloosakAttributes
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
     * it’s 6 digit and unique we sent it to customer phone via SMS
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
     * @param $phone
     * @return FloosakAttributes
     */
    public function setCustomerPhone($phone): FloosakAttributes
    {
        $this->attributes['target_phone'] = $phone;
        return $this;
    }


    /**
     * @param $phone
     * @return FloosakAttributes
     */
    public function setTargetPhone($phone): FloosakAttributes
    {
        $this->attributes['target_phone'] = $phone;
        return $this;
    }


    /**
     * @param $purpose
     * @return FloosakAttributes
     */
    public function setPurpose($purpose): FloosakAttributes
    {
        $this->attributes['purpose'] = $purpose;
        return $this;
    }


    /**
     * @param $amount
     * @return FloosakAttributes
     */
    public function setAmount($amount): FloosakAttributes
    {
        $this->attributes['amount'] = $amount;
        return $this;
    }


    /**
     * @param array $attributes
     * @return FloosakAttributes
     */
    public function setAttributes(array $attributes): FloosakAttributes
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return FloosakAttributes
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
     * @return FloosakAttributes
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
    protected function setMerchantWalletId()
    {
        $this->attributes['source_wallet_id'] = config('floosak.auth.wallet_id');
    }

    /**
     * @return void
     */
    protected function setAuthorization()
    {
        $this->headers['Authorization'] = 'Bearer ' . config('floosak.auth.key');
    }
}
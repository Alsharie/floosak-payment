<?php

namespace Alsharie\FloosakPayment;


use Alsharie\FloosakPayment\Responses\FloosakPurchaseConfirmResponse;
use Alsharie\FloosakPayment\Responses\FloosakPurchaseRequestResponse;
use Alsharie\FloosakPayment\Responses\FloosakPurchaseStatusResponse;
use Alsharie\FloosakPayment\Responses\FloosakRequestKeyResponse;
use Alsharie\FloosakPayment\Responses\FloosakVerifyKeyResponse;
use Exception;

class Floosak extends FloosakAttributes
{


    /**
     * @return FloosakRequestKeyResponse
     * @throws Exception
     */
    public function requestKey(): FloosakRequestKeyResponse
    {
        // set `phone`, and `short_code` .
        $this->setAuthAttributes();

        try {
            $response = $this->sendRequest(
                $this->getRequestKeyPath(),
                $this->attributes
            );

            return new FloosakRequestKeyResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * set request_id and otp before call this method
     *
     * ----------------------------
     *  _important note :_
     * After getting the 'key' and 'request_id' successfull add them to floosk config
     *
     * ------------------------------------
     *
     * @return FloosakVerifyKeyResponse
     * @throws Exception
     */
    public function verifyKey(): FloosakVerifyKeyResponse
    {
        // set `phone`, and `short_code` .
        $this->setAuthAttributes();

        try {
            $response = $this->sendRequest(
                $this->getVerifyKeyPath(),
                $this->attributes
            );

            return new FloosakVerifyKeyResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return FloosakPurchaseRequestResponse
     * @throws Exception
     */
    public function purchase(): FloosakPurchaseRequestResponse
    {
        // set `request_id`, and `key` .
        $this->setMerchantKeyAttributes();

        try {
            $response = $this->sendRequest(
                $this->getPurchaseRequestPath(),
                $this->attributes
            );


            return new FloosakPurchaseRequestResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return FloosakPurchaseConfirmResponse
     * @throws Exception
     */
    public function confirmPurchase(): FloosakPurchaseConfirmResponse
    {
        // set `request_id`, and `key` .
        $this->setMerchantKeyAttributes();

        try {
            $response = $this->sendRequest(
                $this->getPurchaseConfirmPath(),
                $this->attributes
            );

            return new FloosakPurchaseConfirmResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * @return FloosakPurchaseStatusResponse
     * @throws Exception
     */
    public function checkPurchaseStatus(): FloosakPurchaseStatusResponse
    {
        // set `request_id`, and `key` .
        $this->setMerchantKeyAttributes();

        try {
            $response = $this->sendRequest(
                $this->getCheckStatusPath(),
                $this->attributes
            );

            return new FloosakPurchaseStatusResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }




}
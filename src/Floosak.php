<?php

namespace Alsharie\FloosakPayment;


use Alsharie\FloosakPayment\Responses\FloosakErrorResponse;
use Alsharie\FloosakPayment\Responses\FloosakPurchaseConfirmResponse;
use Alsharie\FloosakPayment\Responses\FloosakPurchaseRequestResponse;
use Alsharie\FloosakPayment\Responses\FloosakPurchaseStatusResponse;
use Alsharie\FloosakPayment\Responses\FloosakRequestKeyResponse;
use Alsharie\FloosakPayment\Responses\FloosakVerifyKeyResponse;

class Floosak extends FloosakAttributes
{


    /**
     * @return FloosakRequestKeyResponse|FloosakErrorResponse
     */
    public function requestKey()
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
            return new FloosakErrorResponse($e->getMessage());
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
     * @return FloosakVerifyKeyResponse|FloosakErrorResponse
     */
    public function verifyKey()
    {

        try {
            $response = $this->sendRequest(
                $this->getVerifyKeyPath(),
                $this->attributes
            );

            return new FloosakVerifyKeyResponse((string)$response->getBody());
        } catch (\Throwable $e) {
            return new FloosakErrorResponse($e->getMessage());
        }
    }

    /**
     * @return FloosakPurchaseRequestResponse|FloosakErrorResponse
     */
    public function purchase()
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
            return new FloosakErrorResponse($e->getMessage());
        }
    }

    /**
     * @return FloosakPurchaseConfirmResponse|FloosakErrorResponse
     */
    public function confirmPurchase()
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
            return new FloosakErrorResponse($e->getMessage());
        }
    }


    /**
     * @return FloosakPurchaseStatusResponse|FloosakErrorResponse
     */
    public function checkPurchaseStatus()
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
            return new FloosakErrorResponse($e->getMessage());
        }
    }


}
<?php

namespace Alsharie\FloosakPayment;


use Alsharie\CashPayPayment\Responses\CashPayErrorResponse;
use Alsharie\FloosakPayment\Responses\FloosakBalanceEnquiryResponse;
use Alsharie\FloosakPayment\Responses\FloosakErrorResponse;
use Alsharie\FloosakPayment\Responses\FloosakRefundResponse;
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
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new FloosakErrorResponse($e->getResponse()->getBody(),$e->getResponse()->getStatusCode());
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
         } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new FloosakErrorResponse($e->getResponse()->getBody(),$e->getResponse()->getStatusCode());
        }
    }

    /**
     * @return FloosakPurchaseRequestResponse|FloosakErrorResponse
     */
    public function purchase()
    {
        // set `source_wallet_id`, and `key` .
        $this->setMerchantWalletId();
        $this->setAuthorization();

        try {
            $response = $this->sendRequest(
                $this->getPurchaseRequestPath(),
                $this->attributes,
                $this->headers,
            );


            return new FloosakPurchaseRequestResponse((string)$response->getBody());
         } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new FloosakErrorResponse($e->getResponse()->getBody(),$e->getResponse()->getStatusCode());
        }
    }

    /**
     * @return FloosakPurchaseConfirmResponse|FloosakErrorResponse
     */
    public function confirmPurchase()
    {
        // set `key` .
        $this->setAuthorization();

        try {
            $response = $this->sendRequest(
                $this->getPurchaseConfirmPath(),
                $this->attributes,
                $this->headers,
            );

            return new FloosakPurchaseConfirmResponse((string)$response->getBody());
         } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new FloosakErrorResponse($e->getResponse()->getBody(),$e->getResponse()->getStatusCode());
        }
    }


    /**
     * @return FloosakRefundResponse|FloosakErrorResponse
     */
    public function refund()
    {
        // set  `key` .
        $this->setAuthorization();

        try {
            $response = $this->sendRequest(
                $this->getRefundPath(),
                $this->attributes
            );

            return new FloosakRefundResponse((string)$response->getBody());
         } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new FloosakErrorResponse($e->getResponse()->getBody(),$e->getResponse()->getStatusCode());
        }
    }


}
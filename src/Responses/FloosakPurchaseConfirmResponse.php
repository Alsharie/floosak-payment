<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakPurchaseConfirmResponse extends FloosakResponse
{

    /**
     * @return string
     */
    public function getStatus()
    {
        if (!empty($this->data['data']['status'])) {
            return $this->data['data']['status'];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        if (!empty($this->data['data']['net'])) {
            return $this->data['data']['net'];
        }

        return false;
    }


    /**
     * @return string
     */
    public function getTransactionId()
    {
        if (!empty($this->data['data']['id'])) {
            return $this->data['data']['id'];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getRefId()
    {
        if (!empty($this->data['data']['reference_id'])) {
            return $this->data['data']['reference_id'];
        }

        return false;
    }


}
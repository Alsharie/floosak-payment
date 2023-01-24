<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakRefundResponse extends FloosakResponse
{

    /**
     * @return string
     */
    public function getBalance()
    {
        if (!empty($this->data['data']['balance'])) {
            return $this->data['data']['balance'];
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
    public function getRefundId()
    {
        if (!empty($this->data['data']['id'])) {
            return $this->data['data']['id'];
        }

        return false;
    }


}
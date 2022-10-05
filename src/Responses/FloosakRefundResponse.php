<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakRefundResponse extends FloosakResponse
{

    /**
     * @return string
     */
    public function getBalance()
    {
        if (!empty($this->data['balnce'])) {
            return $this->data['balnce'];
        }

        return false;
    }


    /**
     * @return string
     */
    public function getAmount()
    {
        if (!empty($this->data['amount'])) {
            return $this->data['amount'];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if (!empty($this->data['state'])) {
            return $this->data['state'];
        }

        return false;
    }


    /**
     * @return string
     */
    public function getRefId()
    {
        if (!empty($this->data['ref_id'])) {
            return $this->data['ref_id'];
        }

        return false;
    }


}
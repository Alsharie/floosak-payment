<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakPurchaseRequestResponse extends FloosakResponse
{

    /**
     * @return string
     */
    public function getState()
    {
        if (!empty($this->data['state'])) {
            return $this->data['state'];
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
    public function getPurchaseId()
    {
        if (!empty($this->data['purchase_id'])) {
            return $this->data['purchase_id'];
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
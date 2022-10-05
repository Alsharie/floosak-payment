<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakBalanceEnquiryResponse extends FloosakResponse
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
    public function getDate()
    {
        if (!empty($this->data['t_date'])) {
            return $this->data['t_date'];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        if (!empty($this->data['result'])) {
            return $this->data['result'];
        }

        return false;
    }


    /**
     * @return string
     */
    public function getReqId()
    {
        if (!empty($this->data['req_id'])) {
            return $this->data['req_id'];
        }

        return false;
    }


}
<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakVerifyKeyResponse extends FloosakResponse
{


    /**
     * @return string
     */
    public function getKey()
    {
        if (!empty($this->data['key'])) {
            return $this->data['key'];
        }

        return false;
    }



    /**
     * @return string
     */
    public function getRequestId()
    {
        if (!empty($this->data['request_id'])) {
            return $this->data['request_id'];
        }

        return false;
    }


}
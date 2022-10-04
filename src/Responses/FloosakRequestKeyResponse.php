<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakRequestKeyResponse  extends FloosakResponse
{

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
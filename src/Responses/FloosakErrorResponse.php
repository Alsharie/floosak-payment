<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakErrorResponse extends FloosakResponse
{
    protected $success = false;

    public function __construct($response,$status)
    {
        $this->data = (array) json_decode((string)$response);
        $this->data['status_code'] = $status;
    }

}
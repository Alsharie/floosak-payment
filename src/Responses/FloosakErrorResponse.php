<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakErrorResponse extends FloosakResponse
{
    protected $success = false;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->data = $response;
    }

}
<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakErrorResponse extends FloosakResponse
{
    protected $success = false;
  
    public function isSuccess()
    {
        return $this->success;
    }


}
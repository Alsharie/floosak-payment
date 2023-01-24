<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakResponse
{
    protected $success = true;
    /**
     * Store the response data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Response constructor.
     */
    public function __construct($response)
    {
        $this->data = (array)json_decode($response, true);
    }


    /**
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @return array
     */
    public function body()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->data['message'] ?? '';
    }

    public function isSuccess()
    {
        if (isset($this->data['is_success']))
            return $this->data['is_success'];

        return $this->success;
    }


}
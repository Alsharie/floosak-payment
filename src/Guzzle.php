<?php

namespace Alsharie\FloosakPayment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Guzzle
{
    /**
     * Store guzzle client instance.
     *
     * @var Floosak
     */
    protected $guzzleClient;

    /**
     * Floosak payment base path.
     *
     * @var string
     */
    protected $basePath;


    /**
     * BaseService Constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
        $this->basePath = config('floosak.url.base');
    }

    /**
     * @param $path
     * @param $attributes
     * @param $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function sendRequest($path, $attributes, $method = 'POST'): ResponseInterface
    {
        return $this->guzzleClient->request(
            $method,
            $path,
            [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'json' => $attributes,
            ]
        );
    }


    public function getRequestKeyPath(): string
    {
        return $this->basePath . '/' . "api/merchant/v1/request/key";
    }


    public function getVerifyKeyPath(): string
    {
        return $this->basePath . '/' . "api/merchant/v1/verify/key";
    }

    public function getPurchaseRequestPath(): string
    {
        return $this->basePath . '/' . "api/merchant/v1/purchase/request";
    }

    public function getPurchaseConfirmPath(): string
    {
        return $this->basePath . '/' . "api/merchant/v1/purchase/confirm";
    }

    public function getCheckStatusPath(): string
    {
        return $this->basePath . '/' . "api/merchant/v1/check_status";
    }
}
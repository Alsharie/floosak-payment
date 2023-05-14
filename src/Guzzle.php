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
    protected function sendRequest($path, $attributes, $headers=[], $method = 'POST'): ResponseInterface
    {
        return $this->guzzleClient->request(
            $method,
            $path,
            [
                'headers' => [
                    ...$headers,
                    'Content-Type' => 'application/json',
                    'x-channel' => 'merchant'
                ],
                'json' => $attributes,
            ]
        );
    }


    protected function getRequestKeyPath(): string
    {
        return $this->basePath . '/' . "api/v1/request/key";
    }


    protected function getVerifyKeyPath(): string
    {
        return $this->basePath . '/' . "api/v1/verify/key";
    }

    protected function getPurchaseRequestPath(): string
    {
        return $this->basePath . '/' . "api/v1/merchant/p2mcl";
    }

    protected function getPurchaseConfirmPath(): string
    {
        return $this->basePath . '/' . "api/v1/merchant/p2mcl/confirm";
    }


    protected function getRefundPath(): string
    {
        return $this->basePath . '/' . "api/v1/merchant/p2mcl/refund";
    }

}
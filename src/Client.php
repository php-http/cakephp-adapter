<?php

namespace Http\Adapter\Cake;

use Cake\Http\Client as CakeClient;
use Cake\Http\Client\Request;
use Exception;
use Http\Client\Exception\NetworkException;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Client compatible with PSR7 and Httplug interfaces, using a CakePHP client.
 */
class Client implements HttpClient
{
    /**
     * @var \Cake\Http\Client
     */
    protected $client;

    /**
     * @param \Cake\Http\Client|null $client
     */
    public function __construct(?CakeClient $client = null)
    {
        $this->client = $client ?: new CakeClient();
    }

    /**
     * @inheritdoc
     *
     * @throws \Http\Client\Exception\NetworkException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $cakeRequest = new Request(
            (string)$request->getUri(),
            $request->getMethod(),
            $request->getHeaders(),
        );

        $cakeRequest = $cakeRequest
            ->withProtocolVersion($request->getProtocolVersion())
            ->withBody($request->getBody());

        if (!$cakeRequest->getHeader('Content-Type')) {
            $cakeRequest = $cakeRequest->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        try {
            $response = $this->client->send($cakeRequest, $this->client->getConfig());
        } catch (Exception $exception) {
            throw new NetworkException('Failed to send request', $request, $exception);
        }

        return $response;
    }
}

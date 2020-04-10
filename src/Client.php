<?php

namespace Http\Adapter\Cake;

use Cake\Http\Client as CakeClient;
use Cake\Http\Client\Request;
use Http\Client\Exception\NetworkException;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\ResponseFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Client compatible with PSR7 and Httplug interfaces, using a CakePHP client.
 */
class Client implements HttpClient
{
    /**
     * @var \Cake\Http\Client
     */
    private $client;

    /**
     * @var \Http\Message\ResponseFactory
     */
    private $responseFactory;

    /**
     * @param \Cake\Http\Client|null $client
     * @param \Http\Message\ResponseFactory|null $responseFactory
     */
    public function __construct(CakeClient $client = null, ResponseFactory $responseFactory = null)
    {
        $this->client = $client ?: new CakeClient();
        $this->responseFactory = $responseFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * @inheritdoc
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $cakeRequest = new Request(
            (string) $request->getUri(),
            $request->getMethod(),
            $request->getHeaders()
        );

        $cakeRequest = $cakeRequest
            ->withProtocolVersion($request->getProtocolVersion())
            ->withBody($request->getBody());

        if (!$cakeRequest->getHeader('Content-Type')) {
            $cakeRequest = $cakeRequest->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        try {
            $response = $this->client->send($cakeRequest, $this->client->getConfig());
        } catch (Throwable $exception) {
            throw new NetworkException('Failed to send request', $request, $exception);
        }

        return $response;
    }
}

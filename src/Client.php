<?php

namespace Http\Adapter\Cake;

use Cake\Core\Exception\Exception;
use Cake\Network\Http\Client as CakeClient;
use Cake\Network\Http\Request;
use Http\Client\Exception\NetworkException;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\ResponseFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Client compatible with PSR7 and Httplug interfaces, using a cackephp client.
 */
class Client implements HttpClient
{
    /** @var CakeClient */
    private $client;

    /** @var ResponseFactory */
    private $responseFactory;

    /**
     * @param CakeClient      $client
     * @param ResponseFactory $responseFactory
     */
    public function __construct(CakeClient $client = null, ResponseFactory $responseFactory = null)
    {
        $this->client = $client ?: new CakeClient();
        $this->responseFactory = $responseFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request)
    {
        $cakeRequest = new Request();
        $cakeRequest->method($request->getMethod());
        $cakeRequest->url((string) $request->getUri());
        $cakeRequest->version($request->getProtocolVersion());
        $cakeRequest->body($request->getBody()->getContents());

        foreach ($request->getHeaders() as $header => $values) {
            $cakeRequest->header($header, $request->getHeaderLine($header));
        }

        if (null === $cakeRequest->header('Content-Type')) {
            $cakeRequest->header('Content-Type', 'application/x-www-form-urlencoded');
        }

        try {
            $cakeResponse = $this->client->send($cakeRequest, $this->client->config());
        } catch (Exception $exception) {
            throw new NetworkException('Failed to send request', $request, $exception);
        }

        return $this->responseFactory->createResponse(
            $cakeResponse->statusCode(),
            null,
            $cakeResponse->headers(),
            $cakeResponse->body(),
            $cakeResponse->version()
        );
    }
}
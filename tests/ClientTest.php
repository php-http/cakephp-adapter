<?php

namespace Http\Adapter\Cake\Tests;

use Cake\Http\Client\Response;
use Cake\Http\ServerRequest;
use Http\Adapter\Cake\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstance(): void
    {
        $client = new Client();
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @return void
     */
    public function testSendRequest(): void
    {
        $serverRequest = new ServerRequest();

        $client = new Client();
        $response = $client->sendRequest($serverRequest);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return \Http\Adapter\Cake\Client|\PHPUnit\Framework\MockObject\MockObject
     */
    protected function createHttpAdapterMock(): Client
    {
        return $this->getMockBuilder(Client::class)->getMock();
    }
}

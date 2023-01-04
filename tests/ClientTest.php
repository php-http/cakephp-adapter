<?php

namespace Http\Adapter\Cake\Tests;

use Cake\Http\Client as CakeClient;
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

        $cakeClient = $this->createClientMock();
        $cakeClient->expects($this->once())->method('send')->willReturn(new Response());

        $client = new Client($cakeClient);
        $response = $client->sendRequest($serverRequest);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return \Cake\Http\Client|\PHPUnit\Framework\MockObject\MockObject
     */
    protected function createClientMock(): CakeClient
    {
        return $this->getMockBuilder(CakeClient::class)->onlyMethods(['send'])->getMock();
    }
}

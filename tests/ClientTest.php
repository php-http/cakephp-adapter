<?php

namespace Http\Adapter\Cake\Tests;

use Http\Adapter\Cake\Client;
use Http\Client\Tests\HttpClientTest;

class ClientTest extends HttpClientTest
{
    /**
     * @return \Http\Adapter\Cake\Client
     */
    protected function createHttpAdapter(): Client
    {
        return new Client();
    }
}

<?php

namespace Http\Adapter\Cake\Tests;

use Http\Adapter\Cake\Client;
use Http\Client\Tests\HttpClientTest;

class ClientTest extends HttpClientTest
{
    protected function createHttpAdapter()
    {
        return new Client();
    }
}

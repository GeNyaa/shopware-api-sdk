<?php

namespace GeNyaa\ShopwareApiSdk\Tests\Feature;

use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiAuthenticationException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;
use GeNyaa\ShopwareApiSdk\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class Test extends TestCase
{
    public function testExample(): void
    {
        $this->assertTrue(true);
    }
}
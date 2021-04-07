<?php

namespace GeNyaa\ShopwareApiSdk\Tests\Feature;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiAuthenticationException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;
use GeNyaa\ShopwareApiSdk\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Mockery;

class Test extends TestCase
{
    public function testExample(): void
    {
        Http::fake([
            'shopware.com/api/oauth/token' => Http::response(File::get(__DIR__ . '/../Data/Oauth/Token/200.json'), Response::HTTP_OK),
        ]);

        $shopware = app(ShopwareApiClient::class);

        self::assertEquals('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0', $shopware->bearer);
        self::assertEquals('http://shopware.com', $shopware->domain);
        self::assertInstanceOf(Carbon::class, $shopware->expiresTime);
    }
}
<?php

namespace GeNyaa\ShopwareApiSdk\Tests\Feature;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiAuthenticationException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;
use GeNyaa\ShopwareApiSdk\ShopwareApiSdkServiceProvider;
use GeNyaa\ShopwareApiSdk\Tests\TestCase;
use Orchestra\Testbench\TestCase as ParentTestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class OauthTest extends ParentTestCase
{
    public function testBadRequest(): void
    {
        Http::fake([
            'shopware.com/api/oauth/token' => Http::response(File::get(__DIR__ . '/../Data/Oauth/Token/400.json'), Response::HTTP_BAD_REQUEST),
        ]);

        $this->expectException(ShopwareApiAuthenticationException::class);

        $shopware = app(ShopwareApiClient::class);
    }

    public function testUnauthorized(): void
    {
        Http::fake([
            'shopware.com/api/oauth/token' => Http::response(File::get(__DIR__ . '/../Data/Oauth/Token/401.json'), Response::HTTP_UNAUTHORIZED),
        ]);

        $this->expectException(ShopwareApiAuthenticationException::class);

        $shopware = app(ShopwareApiClient::class);
    }

    public function testSuccessful(): void
    {
        Http::fake([
            'shopware.com/api/oauth/token' => Http::response(File::get(__DIR__ . '/../Data/Oauth/Token/200.json'), Response::HTTP_OK),
        ]);

        $shopware = app(ShopwareApiClient::class);

        self::assertEquals('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0', $shopware->bearer);
        self::assertEquals('http://shopware.com', $shopware->domain);
        self::assertInstanceOf(Carbon::class, $shopware->expiresTime);
    }

    protected function getPackageProviders($app): array
    {
        return [
            ShopwareApiSdkServiceProvider::class,
        ];
    }
}
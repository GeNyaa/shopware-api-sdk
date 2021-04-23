<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Tests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as ParentTestCase;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;
use GeNyaa\ShopwareApiSdk\ShopwareApiSdkServiceProvider;


class TestCase extends ParentTestCase
{
    public ShopwareApiClient $apiClient;

    protected function getPackageProviders($app): array
    {
        return [
            ShopwareApiSdkServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        Http::fake([
            'shopware.com/api/oauth/token' => Http::response(File::get(__DIR__ . '/Data/Oauth/Token/200.json'), Response::HTTP_OK),
        ]);

        $this->apiClient = $app->make(ShopwareApiClient::class);
    }
}
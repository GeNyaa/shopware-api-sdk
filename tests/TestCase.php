<?php

declare(strict_types=1);

namespace ShopWorks\ShopwareApiSdk\Tests;

use \Orchestra\Testbench\TestCase as ParentTestCase;
use ShopWorks\ShopwareApiSdk\ShopwareApiClient;
use ShopWorks\ShopwareApiSdk\ShopwareApiSdkServiceProvider;


class TestCase extends ParentTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ShopwareApiSdkServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // perform environment setup
    }
}
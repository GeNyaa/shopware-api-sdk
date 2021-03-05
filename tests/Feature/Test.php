<?php

namespace ShopWorks\ShopwareApiSdk\Tests\Feature;

use ShopWorks\ShopwareApiSdk\ShopwareApiClient;
use ShopWorks\ShopwareApiSdk\Tests\TestCase;

class Test extends TestCase
{
    public function testBasic(): void
    {
        $shopware = new ShopwareApiClient();
    }
}
<?php

namespace GeNyaa\ShopwareApiSdk\Tests\Feature;

use GeNyaa\ShopwareApiSdk\ShopwareApiClient;
use GeNyaa\ShopwareApiSdk\Tests\TestCase;

class Test extends TestCase
{
    public function testBasic(): void
    {
        $shopware = new ShopwareApiClient();
    }
}
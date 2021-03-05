<?php

namespace ShopWorks\ShopwareApiSdk\Tests\Feature;

use Tests\TestCase;

class Test extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Product;
use Illuminate\Support\Collection;

class ProductEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/product';

    protected string $resource = 'product';

    public function all(): Collection
    {
        return parent::all()->mapInto(Product::class);
    }
}

<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Manufacturer;

class ManufacturerEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/product-manufacturer';

    protected string $resource = 'product_manufacturer';

    public  function first(): ?Manufacturer
    {
        $manufacturer = parent::first();

        return is_null($manufacturer) ? null : $this->mapInto($manufacturer);
    }

    public function mapInto(array $manufacturer): Manufacturer
    {
        return new Manufacturer(
            $manufacturer['id'],
            $manufacturer['name'],
            $manufacturer['description'],
            $manufacturer['link'],
        );
    }
}

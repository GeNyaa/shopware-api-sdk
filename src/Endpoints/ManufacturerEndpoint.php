<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Manufacturer;
use GeNyaa\ShopwareApiSdk\Dto\Resources\ManufacturerCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class ManufacturerEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/product-manufacturer';

    protected string $resource = 'product_manufacturer';

    /**
     * @throws ShopwareApiException
     */
    public function all(): ManufacturerCollection
    {
        return (new ManufacturerCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?Manufacturer
    {
        $manufacturer = $this->restFirst();

        return is_null($manufacturer) ? null : $this->mapInto($manufacturer);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Manufacturer $manufacturer): Manufacturer
    {
        $this->restCreate($manufacturer);
        return $manufacturer;
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

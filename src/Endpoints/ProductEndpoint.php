<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\CategoryCollection;
use GeNyaa\ShopwareApiSdk\Dto\Resources\PriceCollection;
use GeNyaa\ShopwareApiSdk\Dto\Resources\Product;
use GeNyaa\ShopwareApiSdk\Dto\Resources\ProductCollection;
use GeNyaa\ShopwareApiSdk\Dto\Resources\PropertyOptionCollection;
use GeNyaa\ShopwareApiSdk\Dto\Variables\CustomFields;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use Illuminate\Support\Collection;

class ProductEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/product';

    protected string $resource = 'product';

    /**
     * @throws ShopwareApiException
     */
    public function all(): ProductCollection
    {
        return (new ProductCollection())->merge($this->restAll());
    }

    public function first(): ?Product
    {
        $product = $this->restFirst();

        return is_null($product) ? null : $this->mapInto($product);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Product $product): Product
    {
        $this->restCreate($product);
        return $product;
    }

    public function mapInto(array $product): Product
    {
        return new Product(
            $product['id'],
            $product['name'],
            $product['taxId'] ?? null,
           (new PriceCollection($product['price'] ?? null))->mapPrices(),
            $product['productNumber'] ?? null,
            $product['stock'] ?? null,
            $product['active'] ?? null,
            $product['purchaseUnit'] ?? null,
            $product['manufacturerId'] ?? null,
            new CategoryCollection($product['categories'] ?? null),
            new CustomFields($product['customFields'] ?? []),
            new PropertyOptionCollection($product['properties'] ?? null),
        );
    }
}

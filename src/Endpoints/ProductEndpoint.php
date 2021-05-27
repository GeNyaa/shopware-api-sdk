<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Product;
use GeNyaa\ShopwareApiSdk\Dto\Resources\ProductCollection;
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
        return (new ProductCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
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
            $product['taxId'],
            $product['price'],
            $product['productNumber'],
            $product['stock'],
            $product['active'],
            $product['purchaseUnit'],
            $product['manufacturerId'],
            collect($product['categories']),
            $product['customFields'],
            collect($product['properties']),
        );
    }
}

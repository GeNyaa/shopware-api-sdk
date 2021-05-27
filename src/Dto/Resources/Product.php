<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;

use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;
use GeNyaa\ShopwareApiSdk\Dto\Variables\CustomFields;
use Illuminate\Support\Collection;

final class Product extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $taxId,
        public ?PriceCollection $price,
        public ?string $productNumber,
        public ?int $stock,
        public ?bool $active,
        public int|float|null $purchaseUnit = null,
        public ?string $manufacturerId = null,
        public ?CategoryCollection $categories = null,
        public ?CustomFields $customFields = null,
        public ?PropertyOptionCollection $properties = null,
    )
    {
    }

    public function toArray(): array
    {
        $product = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        if (!is_null($this->active)) {
            $product['active'] = $this->active;
        }

        if (!is_null($this->stock)) {
            $product['stock'] = $this->stock;
        }

        if (!is_null($this->taxId)) {
            $product['taxId'] = $this->taxId;
        }

        if (!is_null($this->price)) {
            $product['price'] = $this->price->toArray();
        }

        if (!is_null($this->productNumber)) {
            $product['productNumber'] = $this->productNumber;
        }

        if (!is_null($this->purchaseUnit)) {
            $product['purchaseUnit'] = $this->purchaseUnit;
        }

        if (!is_null($this->categories)) {
            $product['categories'] = $this->categories->toArray();
        }

        if (!is_null($this->customFields)) {
            $product['customFields'] = $this->customFields->toArray();
        }

        if (!is_null($this->properties)) {
            $product['properties'] = $this->properties->toArray();
        }

        if (!is_null($this->manufacturerId)) {
            $product['manufacturerId'] = $this->manufacturerId;
        }

        return $product;
    }
}

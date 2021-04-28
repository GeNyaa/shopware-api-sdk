<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Product implements Arrayable
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $taxId,
        public ?Collection $price,
        public ?string $productNumber,
        public int $stock,
        public bool $active,
        public int|float|null $purchaseUnit = null,
        public ?string $manufacturerId = null,
        public ?Collection $categories = null,
        public ?array $customFields = null,
        public ?Collection $properties = null,
    )
    {
    }

    public function toArray(): array
    {
        $product = [
            'id' => $this->id,
            'name' => $this->name,
            'stock' => $this->stock,
            'active' => $this->active,
        ];

        if (!is_null($this->taxId)) {
            $product['taxId'] = $this->taxId;
        }

        if (!is_null($this->price)) {
            $product['price'] = $this->price;
        }

        if (!is_null($this->productNumber)) {
            $product['productNumber'] = $this->productNumber;
        }

        if (!is_null($this->purchaseUnit)) {
            $product['purchaseUnit'] = $this->purchaseUnit;
        }

        if (!is_null($this->categories)) {
            $product['categories'] = $this->categories;
        }

        if (!is_null($this->customFields)) {
            $product['customFields'] = $this->customFields;
        }

        if (!is_null($this->properties)) {
            $product['properties'] = $this->properties;
        }

        if (!is_null($this->manufacturerId)) {
            $product['manufacturerId'] = $this->manufacturerId;
        }

        return $product;
    }
}

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
        public ?Collection $categories = null,
        public ?Collection $customFields = null,
        public ?Collection $properties = null,
    )
    {
    }

    public function toArray(): array
    {
        return []; // TODO: Implement toArray() method.
    }
}

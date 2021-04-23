<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


class Price implements Arrayable
{
    public function __construct(
        public ?string $currencyId = null,
        public int|float|null $net = null,
        public int|float|null $gross = null,
    )
    {
    }

    public function toArray(): array
    {
        return []; // TODO: Implement toArray() method.
    }
}
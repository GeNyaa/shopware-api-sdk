<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


class Currency implements Arrayable
{
    public function __construct(
        public string $id,
        public ?string $name,
        public ?string $shortName,
        public string $isoCode,
        public string $symbol,
        public int|float $factor,
        public int $decimalPrecision,
    )
    {
    }

    public function toArray(): array
    {
        return []; // TODO: Implement toArray() method.
    }

}

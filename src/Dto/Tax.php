<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


class Tax implements Arrayable
{
    public function __construct(
        public string $id,
        public string $name,
        public float|int $taxRate
    )
    {
    }

    public function toArray(): array
    {
        return []; // TODO: Implement toArray() method.
    }
}

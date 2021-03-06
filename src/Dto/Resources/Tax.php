<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;

class Tax extends DtoAbstract
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'taxRate' => $this->taxRate,
        ];
    }
}

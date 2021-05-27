<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;

final class Price extends DtoAbstract
{
    public function __construct(
        public ?string $currencyId = null,
        public int|float|null $net = null,
        public int|float|null $gross = null,
        public ?bool $linked = null,
    )
    {
    }

    public function toArray(): array
    {
        $price = [
            'currencyId' => $this->currencyId,
        ];

        if (!is_null($this->net)) {
            $price['net'] = $this->net;
        }

        if (!is_null($this->gross)) {
            $price['gross'] = $this->gross;
        }

        if (!is_null($this->linked)) {
            $price['linked'] = $this->linked;
        }

        return $price;
    }
}

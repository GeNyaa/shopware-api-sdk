<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


final class Price extends DtoAbstract
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
        $price = [
            'currencyId' => $this->currencyId,
        ];

        if (!is_null($this->net)) {
            $price['net'] = $this->net;
        }

        if (!is_null($this->gross)) {
            $price['gross'] = $this->gross;
        }

        return $price;
    }
}

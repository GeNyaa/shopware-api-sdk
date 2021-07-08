<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use Illuminate\Support\Collection;

class PriceCollection extends Collection
{
    public function mapPrices(): self
    {
        return $this->map(function (array|Price $price) {
            if ($price instanceof Price) {
                return $price;
            }

            return new Price(
                $price['currencyId'],
                $price['net'],
                $price['gross'],
                $price['linked'],
            );
         });
    }
}

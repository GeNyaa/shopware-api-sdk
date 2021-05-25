<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;

final class Currency extends DtoAbstract
{
    public function __construct(
        public string $id,
        public ?string $name,
        public ?string $shortName,
        public string $isoCode,
        public string $symbol,
        public int|float $factor,
        public int $decimalPrecision,
        public ?array $translations = null,
    )
    {
    }

    public function toArray(): array
    {
        $currency = [
            'id' => $this->id,
            'name' => $this->name,
            'shortName' => $this->shortName,
            'isoCode' => $this->isoCode,
            'symbol' => $this->symbol,
            'factor' => $this->factor,
            'decimalPrecision' => $this->decimalPrecision,
        ];

        if (!is_null($this->translations)) {
            $currency['translations'] = $this->translations;
        }

        return $currency; // TODO: Implement toArray() method.
    }

}

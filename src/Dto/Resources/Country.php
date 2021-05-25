<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;
use phpDocumentor\Reflection\Types\Collection;

final class Country extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $name,
        public string $iso,
        public int $position,
        public bool $active,
        public bool $shippingAvailable,
        public string $iso3,
        public bool $displayStateInRegistration,
        public bool $forceStateInRegistration,
        public bool $companyTaxFree,
        public bool $checkVatIdPattern,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'iso' => $this->iso,
            'position' => $this->position,
            'active' => $this->active,
            'shippingAvailable' => $this->shippingAvailable,
            'iso3' => $this->iso3,
            'displayStateInRegistration' => $this->displayStateInRegistration,
            'forceStateInRegistration' => $this->forceStateInRegistration,
            'companyTaxFree' => $this->companyTaxFree,
            'checkVatIdPattern' => $this->checkVatIdPattern,
        ];
    }

}

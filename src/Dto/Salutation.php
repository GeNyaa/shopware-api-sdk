<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


final class Salutation extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $salutationKey,
        public string $displayName,
        public string $letterName,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'salutationKey' => $this->salutationKey,
            'displayName' => $this->displayName,
            'letterName' => $this->letterName,
        ];
    }

}

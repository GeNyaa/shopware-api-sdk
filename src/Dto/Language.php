<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


class Language implements Arrayable
{
    public function __construct(
        public string $id,
        public string $name,
        public string $isoCode,
        public string $locale,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isoCode' => $this->isoCode,
            'locale' => $this->locale,
        ];
    }
}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

class Parameters implements Arrayable
{
    const FILTER_TYPE_EQUALS = 'equals';
    const FILTER_TYPE_EQUALS_ANY = 'equalsAny';
    const FILTER_TYPE_CONTAINS = 'contains';
    const FILTER_TYPE_RANGE = 'range';
    const FILTER_TYPE_NOT = 'not';
    const FILTER_TYPE_MULTI = 'multi';
    const FILTER_TYPE_PREFIX = 'prefix';
    const FILTER_TYPE_SUFFIX = 'suffix';

    public function __construct(
        private array $parameters = []
    )
    {
    }

    public function set(string $key, mixed $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    public function setFilter(string $key, mixed $value, string $type = self::FILTER_TYPE_EQUALS): self
    {
        $this->parameters['filter'][] = [
            'type' => $type,
            'field' => $key,
            'value' => $value,
        ];

        return $this;
    }

    public function get(string $key): mixed
    {
        return $this->parameters[$key];
    }

    public function toArray(): array
     {
         return $this->parameters;
     }
}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

class Parameters implements Arrayable
{
    public function __construct(
        public array $parameters = []
    )
    {
        $this->parameters = array_merge($this->parameters, [
            'limit' => ShopwareApiClient::PAGE_LIMIT
        ]);
    }

    public function set(string $key, mixed $value): self
    {
        $this->parameters[$key] = $value;

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
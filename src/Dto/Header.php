<?php

declare(strict_types=1);


namespace ShopWorks\ShopwareApiSdk\Dto;

use ShopWorks\ShopwareApiSdk\Dto\Arrayable;

class Header implements Arrayable
{
    public function __construct(
        public array $headers = []
    )
    {
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use GeNyaa\ShopwareApiSdk\Dto\Arrayable;

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

    public function set(string $key, string $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function get(string $key): ?string
    {
        return $this->headers[$key];
    }

    public function setLanguage(string $id): self
    {
        $this->set('sw-language-id', $id);

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->get('sw-language-id');
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}

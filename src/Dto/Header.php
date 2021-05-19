<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use GeNyaa\ShopwareApiSdk\Dto\Arrayable;

final class Header extends DtoAbstract
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
        return $this->headers[$key] ?? null;
    }

    public function delete(string $key): self
    {
        unset($this->headers[$key]);

        return $this;
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

    public function deleteLanguage(): self
    {
        $this->delete('sw-language-id');

        return $this;
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}

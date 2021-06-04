<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Dto\Variables;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use GeNyaa\ShopwareApiSdk\Dto\Jsonable;

class CustomFields implements Arrayable, Jsonable
{
    public function __construct(
        protected ?array $customFields = null
    )
    {
        $this->customFields = is_null($this->customFields) ? [] : $this->customFields;
    }

    public function get(string $key): mixed
    {
        return $this->customFields[$key] ?? null;
    }

    public function set(string $key, mixed $value): self
    {
        $this->customFields[$key] = $value;

        return $this;
    }

    public function delete(string $key): self
    {
        unset($this->customFields[$key]);

        return $this;
    }

    public function toArray(): array
    {
        return $this->customFields;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}

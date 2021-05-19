<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Dto\Variables;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class CustomFields implements Arrayable, Jsonable
{
    public function __construct(
        protected array $customFields = []
    )
    {
    }

    public function get(string $key): mixed
    {
        return $this->customFields[$key] ?? null;
    }

    public function set(string $key, string $value): self
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
}

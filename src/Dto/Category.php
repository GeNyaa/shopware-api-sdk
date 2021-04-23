<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use Carbon\Carbon;

class Category implements Arrayable
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $parentId = null,
        public bool $active = true,
        public bool $visible = true,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parentId,
            'name' => $this->name,
            'active' => $this->active,
            'visible' => $this->visible,
        ];
    }
}

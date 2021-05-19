<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


final class PaymentMethod extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public int $position,
        public bool $active,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'position' => $this->position,
            'active' => $this->active,
        ];
    }

}

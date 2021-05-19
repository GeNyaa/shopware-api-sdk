<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


final class PropertyOption extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $groupId,
        public ?string $name,
        public ?int $position = null,
        public ?array $translations = null
    )
    {
    }

    public function toArray(): array
    {
        $propertyOption = [
            'id' => $this->id,
            'groupId' => $this->groupId,
        ];

        if (!is_null($this->name)) {
            $propertyOption['name'] = $this->name;
        }

        if (!is_null($this->position)) {
            $propertyOption['position'] = $this->position;
        }

        if (!is_null($this->translations)) {
            $propertyOption['translations'] = $this->translations;
        }

        return $propertyOption;
    }
}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use Illuminate\Support\Collection;

class Property implements Arrayable
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public ?int $position,
        public bool $filterable,
        public ?Collection $options,
        public ?array $translations,
    )
    {
    }

    public function toArray(): array
     {
         $property = [
            'id' => $this->id,
            'name' => $this->name,
            'filterable' => $this->filterable,
         ];

         if (!is_null($this->description)) {
            $property['description'] = $this->description;
         }

         if (!is_null($this->position)) {
             $property['position'] = $this->position;
         }

         if (!is_null($this->options)) {
             $property['options'] = $this->options;
         }

         if (!is_null($this->translations)) {
             $property['translations'] = $this->translations;
         }

         return $property;
     }
}

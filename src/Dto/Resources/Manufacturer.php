<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;

final class Manufacturer extends DtoAbstract
{
    public function __construct(
        public string $id,
        public ?string $name,
        public ?string $description = null,
        public ?string $link = null,
        public ?array $translations = null,
    )
    {
    }

    public function toArray(): array
     {
         $manufacturer = [
             'id' => $this->id,
         ];

         if (!is_null($this->name)) {
             $manufacturer['name'] = $this->name;
         }

         if (!is_null($this->description)) {
             $manufacturer['description'] = $this->description;
         }

         if (!is_null($this->link)) {
             $manufacturer['link'] = $this->link;
         }

         if (!is_null($this->translations)) {
             $manufacturer['translations'] = $this->translations;
         }

         return $manufacturer;
     }
}

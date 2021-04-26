<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Property;

class PropertyEndpoint extends EndpointAbstract
{
    public function first(): ?Property
    {
        $property = parent::first();

        return is_null($property) ? null : $this->mapInto($property);
    }

    private function mapInto(array $property): Property
    {
        dd($property);

        return new Property(
            $property['id'],
            $property['name'],
            $property['parentId'],
            $property['active'],
            $property['visible'],
        );
    }
}

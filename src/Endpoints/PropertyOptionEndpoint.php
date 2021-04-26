<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use Exception;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Dto\Property;
use GeNyaa\ShopwareApiSdk\Dto\PropertyOption;
use Illuminate\Support\Collection;

class PropertyOptionEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/property-group-option';

    protected string $resource = 'property_group_option';

    public function first(): ?Property
    {
        $propertyOption = parent::first();

        if (is_null($propertyOption)) {
            return null;
        }

        $property['options'] = $this->getOptions($propertyOption['id']);

        return $this->mapInto($propertyOption);
    }

    public function mapInto(array $propertyOption): PropertyOption
    {
        return new PropertyOption(
            $propertyOption['id'],
            $propertyOption['groupId'],
            $propertyOption['name'],
            $propertyOption['position'],
            $propertyOption['translations'],
        );
    }
}

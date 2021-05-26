<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\PropertyOption;
use GeNyaa\ShopwareApiSdk\Dto\Resources\PropertyOptionCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class PropertyOptionEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/property-group-option';

    protected string $resource = 'property_group_option';

    /**
     * @throws ShopwareApiException
     */
    public function all(): PropertyOptionCollection
    {
        return (new PropertyOptionCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?PropertyOption
    {
        $propertyOption = parent::first();

        return is_null($propertyOption) ? null : $this->mapInto($propertyOption);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(PropertyOption $propertyOption): PropertyOption
    {
        $this->restCreate($propertyOption);
        return $propertyOption;
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

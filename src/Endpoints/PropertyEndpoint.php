<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Dto\Resources\Property;
use GeNyaa\ShopwareApiSdk\Dto\Resources\PropertyCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use Illuminate\Support\Collection;

class PropertyEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/property-group';

    protected string $resource = 'property_group';

    /**
     * @throws ShopwareApiException
     */
    public function all(): PropertyCollection
    {
        return (new PropertyCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?Property
    {
        $property = $this->restFirst();

        if (is_null($property)) {
            return null;
        }

        $property['options'] = $this->getOptions($property['id']);

        return $this->mapInto($property);
    }

    public function getOptions(string $propertyId): ?Collection
    {
        if (is_null($this->parameters)) {
            $this->parameters = new Parameters();
        }

        $parameters = (new Parameters())->setFilter('groupId', $propertyId);

        $response = $this->client->performGetRequest(
            sprintf('%s-option', $this->resourcePath),
            $parameters,
            $this->header,
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        if (is_null($response->json()['data'])) {
            return collect();
        }

        return collect($response->json()['data'])->map(function (array $option) {
            return $this->client->propertyOption->mapInto($option);
        });
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Property $property): Property
    {
        $this->restCreate($property);
        return $property;
    }

    public function mapInto(array $property): Property
    {
        return new Property(
            $property['id'],
            $property['name'],
            $property['description'],
            $property['position'],
            $property['filterable'],
            $property['options'],
            $property['translations'],
        );
    }
}

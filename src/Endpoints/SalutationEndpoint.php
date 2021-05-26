<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Salutation;
use GeNyaa\ShopwareApiSdk\Dto\Resources\SalutationCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class SalutationEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/salutation';

    protected string $resource = 'salutation';

    /**
     * @throws ShopwareApiException
     */
    public function all(): SalutationCollection
    {
        return (new SalutationCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public  function first(): ?Salutation
    {
        $salutation = parent::first();

        return is_null($salutation) ? null : $this->mapInto($salutation);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Salutation $salutation): Salutation
    {
        $this->restCreate($salutation);
        return $salutation;
    }

    public function mapInto(array $salutation): Salutation
    {
        return new Salutation(
            $salutation['id'],
            $salutation['salutationKey'],
            $salutation['displayName'],
            $salutation['letterName'],
        );
    }
}

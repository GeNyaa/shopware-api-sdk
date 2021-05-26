<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Salutation;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class SalutationEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/salutation';

    protected string $resource = 'salutation';

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
        $this->createParent($salutation);
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

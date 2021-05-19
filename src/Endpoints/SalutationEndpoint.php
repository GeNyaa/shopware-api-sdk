<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Currency;
use GeNyaa\ShopwareApiSdk\Dto\Salutation;

class SalutationEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/salutation';

    protected string $resource = 'salutation';

    public  function first(): ?Salutation
    {
        $salutation = parent::first();

        return is_null($salutation) ? null : $this->mapInto($salutation);
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

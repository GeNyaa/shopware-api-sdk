<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Category;
use GeNyaa\ShopwareApiSdk\Dto\Tax;

class TaxEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/tax';

    protected string $resource = 'tax';

    public  function first(): ?Tax
    {
        $tax = parent::first();

        return is_null($tax) ? null : $this->mapInto($tax);
    }

    private function mapInto(array $tax): Tax
    {
        return new Tax(
            $tax['id'],
            $tax['name'],
            $tax['taxRate']
        );
    }
}

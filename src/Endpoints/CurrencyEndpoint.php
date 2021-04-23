<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Currency;

class CurrencyEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/currency';

    protected string $resource = 'currency';

    public  function first(): ?Currency
    {
        $currency = parent::first();

        return is_null($currency) ? null : $this->mapInto($currency);
    }
}

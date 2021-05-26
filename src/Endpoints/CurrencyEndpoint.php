<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Currency;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CurrencyEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/currency';

    protected string $resource = 'currency';

    public  function first(): ?Currency
    {
        $currency = parent::first();

        return is_null($currency) ? null : $this->mapInto($currency);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Currency $currency): Currency
    {
        $this->createParent($currency);
        return $currency;
    }

    public function mapInto(array $currency): Currency
    {
        return new Currency(
            $currency['id'],
            $currency['name'],
            $currency['shortName'],
            $currency['isoCode'],
            $currency['symbol'],
            $currency['factor'],
            $currency['decimalPrecision'],
        );
    }
}

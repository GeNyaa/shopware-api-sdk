<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Currency;
use GeNyaa\ShopwareApiSdk\Dto\Resources\CurrencyCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CurrencyEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/currency';

    protected string $resource = 'currency';

    /**
     * @throws ShopwareApiException
     */
    public function all(): CurrencyCollection
    {
        return (new CurrencyCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?Currency
    {
        $currency = $this->restFirst();

        return is_null($currency) ? null : $this->mapInto($currency);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Currency $currency): Currency
    {
        $this->restCreate($currency);
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

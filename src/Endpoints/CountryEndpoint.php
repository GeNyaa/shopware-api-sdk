<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Country;
use GeNyaa\ShopwareApiSdk\Dto\Currency;

class CountryEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/country';

    protected string $resource = 'country';

    public  function first(): ?Country
    {
        $country = parent::first();

        return is_null($country) ? null : $this->mapInto($country);
    }

    public function mapInto(array $country): Country
    {
        return new Country(
            $country['id'],
            $country['name'],
            $country['iso'],
            $country['position'],
            $country['active'],
            $country['shippingAvailable'],
            $country['iso3'],
            $country['displayStateInRegistration'],
            $country['forceStateInRegistration'],
            $country['companyTaxFree'],
            $country['checkVatIdPattern'],
        );
    }
}

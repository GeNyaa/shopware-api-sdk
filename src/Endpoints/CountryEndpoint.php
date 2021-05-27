<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Country;
use GeNyaa\ShopwareApiSdk\Dto\Resources\CountryCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CountryEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/country';

    protected string $resource = 'country';

    /**
     * @throws ShopwareApiException
     */
    public function all(): CountryCollection
    {
        return (new CountryCollection())->merge($this->restAll());
    }

    public function first(): ?Country
    {
        $country = $this->restFirst();

        return is_null($country) ? null : $this->mapInto($country);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Country $country): Country
    {
        $this->restCreate($country);
        return $country;
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

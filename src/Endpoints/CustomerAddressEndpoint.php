<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\CustomerAddress;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CustomerAddressEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/customer-address';

    protected string $resource = 'customer_address';

    public  function first(): ?CustomerAddress
    {
        $customerAddress = parent::first();

        return is_null($customerAddress) ? null : $this->mapInto($customerAddress);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(CustomerAddress $customerAddress): CustomerAddress
    {
        $this->createParent($customerAddress);
        return $customerAddress;
    }

    public function mapInto(array $customerAddress): CustomerAddress
    {
        return new CustomerAddress(
            $customerAddress['id'],
            $customerAddress['countryId'],
            $customerAddress['salutationId'],
            $customerAddress['firstName'],
            $customerAddress['lastName'],
            $customerAddress['zipcode'],
            $customerAddress['city'],
            $customerAddress['street'],
            $customerAddress['additionalAddressLine1'],
            $customerAddress['additionalAddressLine2'],
            $customerAddress['phoneNumber'],
            $customerAddress['company'],
            $customerAddress['department'],
            $customerAddress['vatId'],
            $customerAddress['customerId'],
        );
    }
}

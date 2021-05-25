<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Customer;

class CustomerEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/customer';

    protected string $resource = 'customer';

    public  function first(): ?Customer
    {
        $customer = parent::first();

        return is_null($customer) ? null : $this->mapInto($customer);
    }

    public function mapInto(array $customer): Customer
    {
        return new Customer(
            $customer['id'],
            $customer['salutationId'],
            $customer['company'],
            $customer['firstName'],
            $customer['lastName'],
            $customer['email'],
            $customer['groupId'],
            $customer['salesChannelId'],
            $customer['languageId'],
            $customer['customerNumber'],
            $customer['defaultBillingAddressId'],
            $customer['defaultPaymentMethodId'],
            $customer['defaultShippingAddressId'],
            vatIds: is_null($customer['vatIds']) ? null : collect($customer['vatIds']),
        );
    }
}

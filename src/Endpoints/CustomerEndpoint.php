<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Customer;
use GeNyaa\ShopwareApiSdk\Dto\Resources\CustomerCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CustomerEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/customer';

    protected string $resource = 'customer';

    /**
     * @throws ShopwareApiException
     */
    public function all(): CustomerCollection
    {
        return (new CustomerCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?Customer
    {
        $customer = $this->restFirst();

        return is_null($customer) ? null : $this->mapInto($customer);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Customer $customer): Customer
    {
        $this->restCreate($customer);
        return $customer;
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

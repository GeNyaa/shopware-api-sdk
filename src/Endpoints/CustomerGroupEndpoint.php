<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\CustomerGroup;
use GeNyaa\ShopwareApiSdk\Dto\Resources\CustomerGroupCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CustomerGroupEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/customer-group';

    protected string $resource = 'customer_group';

    /**
     * @throws ShopwareApiException
     */
    public function all(): CustomerGroupCollection
    {
        return (new CustomerGroupCollection())->merge($this->restAll());
    }

    public function first(): ?CustomerGroup
    {
        $customerGroup = $this->restFirst();

        return is_null($customerGroup) ? null : $this->mapInto($customerGroup);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(CustomerGroup $customerGroup): CustomerGroup
    {
        $this->restCreate($customerGroup);
        return $customerGroup;
    }

    public function mapInto(array $customerGroup): CustomerGroup
    {
        return new CustomerGroup(
            $customerGroup['id'],
            $customerGroup['name'],
            $customerGroup['displayGross'],
        );
    }
}

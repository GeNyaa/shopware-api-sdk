<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\CustomerGroup;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CustomerGroupEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/customer-group';

    protected string $resource = 'customer_group';

    public  function first(): ?CustomerGroup
    {
        $customerGroup = parent::first();

        return is_null($customerGroup) ? null : $this->mapInto($customerGroup);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(CustomerGroup $customerGroup): CustomerGroup
    {
        $this->createParent($customerGroup);
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

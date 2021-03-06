<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto\Resources;


use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;
use GeNyaa\ShopwareApiSdk\Dto\Variables\CustomFields;
use Illuminate\Support\Collection;

final class Customer extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $salutationId,
        public ?string $company,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $groupId,
        public string $salesChannelId,
        public string $languageId,
        public string $customerNumber,
        public ?string $defaultBillingAddressId = null,
        public ?string $defaultPaymentMethodId = null,
        public ?string $defaultShippingAddressId = null,
        public ?CustomerAddressCollection $addresses = null,
        public ?Collection $vatIds = null,
        public ?CustomFields $customFields = null,
    )
    {
    }

    public function toArray(): array
    {
        $customer = [
            'id' => $this->id,
            'salutationId' => $this->salutationId,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'groupId' => $this->groupId,
            'salesChannelId' => $this->salesChannelId,
            'languageId' => $this->languageId,
            'customerNumber' => $this->customerNumber,
        ];

        if (!is_null($this->company)) {
            $customer['company'] = $this->company;
        }

        if (!is_null($this->defaultBillingAddressId)) {
            $customer['defaultBillingAddressId'] = $this->defaultBillingAddressId;
        }

        if (!is_null($this->defaultPaymentMethodId)) {
            $customer['defaultPaymentMethodId'] = $this->defaultPaymentMethodId;
        }

        if (!is_null($this->defaultShippingAddressId)) {
            $customer['defaultShippingAddressId'] = $this->defaultShippingAddressId;
        }

        if (!is_null($this->addresses)) {
            $customer['addresses'] = $this->addresses->toArray();
        }

        if (!is_null($this->vatIds)) {
            $customer['vatIds'] = $this->vatIds->toArray();
        }

        if (!is_null($this->customFields)) {
            $customer['customFields'] = $this->customFields->toArray();
        }

        return $customer;
    }

}

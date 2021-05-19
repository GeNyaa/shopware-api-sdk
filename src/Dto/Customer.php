<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use Illuminate\Support\Collection;

final class Customer extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $salutationId,
        public string $company,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $customerGroup,
        public string $salesChannelId,
        public string $languageId,
        public string $customerNumber,
        public ?string $defaultBillingAddressId = null,
        public ?string $defaultPaymentMethodId = null,
        public ?string $defaultShippingAddressId = null,
        public ?Collection $addresses = null,
        public ?Collection $vatIds = null,
    )
    {
    }

    public function toArray(): array
    {
        $customer = [
            'id' => $this->id,
            'salutationId' => $this->salutationId,
            'company' => $this->company,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'customerGroup' => $this->customerGroup,
            'salesChannelId' => $this->salesChannelId,
            'languageId' => $this->languageId,
            'paymentMethod' => $this->paymentMethod,
            'customerNumber' => $this->customerNumber,
        ];

        if (!is_null($this->defaultBillingAddressId)) {
            $currency['defaultBillingAddressId'] = $this->defaultBillingAddressId;
        }

        if (!is_null($this->defaultPaymentMethodId)) {
            $currency['defaultPaymentMethodId'] = $this->defaultPaymentMethodId;
        }

        if (!is_null($this->defaultShippingAddressId)) {
            $currency['defaultShippingAddressId'] = $this->defaultShippingAddressId;
        }

        if (!is_null($this->addresses)) {
            $currency['addresses'] = $this->addresses;
        }

        if (!is_null($this->vatIds)) {
            $currency['vatIds'] = $this->vatIds;
        }

        return $customer;
    }

}

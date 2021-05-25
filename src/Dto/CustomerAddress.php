<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


final class CustomerAddress extends DtoAbstract
{
    public function __construct(
        public string $id,
        public string $countryId,
        public string $salutationId,
        public string $firstName,
        public string $lastName,
        public string $zipcode,
        public string $city,
        public string $street,
        public ?string $additionalAddressLine1 = null,
        public ?string $additionalAddressLine2 = null,
        public ?string $phoneNumber = null,
        public ?string $company = null,
        public ?string $department = null,
        public ?string $vatId = null,
        public ?string $customerId = null,
    )
    {
    }

    public function toArray(): array
    {
        $customerAddress = [
            'id' => $this->id,
            'countryId' => $this->countryId,
            'salutationId' => $this->salutationId,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'street' => $this->street,
        ];

        if (!is_null($this->additionalAddressLine1)) {
            $customerAddress['additionalAddressLine1'] = $this->additionalAddressLine1;
        }

        if (!is_null($this->additionalAddressLine2)) {
            $customerAddress['additionalAddressLine2'] = $this->additionalAddressLine2;
        }

        if (!is_null($this->phoneNumber)) {
            $customerAddress['phoneNumber'] = $this->phoneNumber;
        }

        if (!is_null($this->company)) {
            $customerAddress['company'] = $this->company;
        }

        if (!is_null($this->department)) {
            $customerAddress['department'] = $this->department;
        }

        if (!is_null($this->vatId)) {
            $customerAddress['vatId'] = $this->vatId;
        }

        if (!is_null($this->customerId)) {
            $customerAddress['customerId'] = $this->customerId;
        }

        return $customerAddress;
    }

}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\PaymentMethod;

class PaymentMethodEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/payment-method';

    protected string $resource = 'payment_method';

    public  function first(): ?PaymentMethod
    {
        $paymentMethod = parent::first();

        return is_null($paymentMethod) ? null : $this->mapInto($paymentMethod);
    }

    public function mapInto(array $paymentMethod): PaymentMethod
    {
        return new PaymentMethod(
            $paymentMethod['id'],
            $paymentMethod['name'],
            $paymentMethod['description'],
            $paymentMethod['position'],
            $paymentMethod['active'],
        );
    }
}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\PaymentMethod;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class PaymentMethodEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/payment-method';

    protected string $resource = 'payment_method';

    public  function first(): ?PaymentMethod
    {
        $paymentMethod = parent::first();

        return is_null($paymentMethod) ? null : $this->mapInto($paymentMethod);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(PaymentMethod $paymentMethod): PaymentMethod
    {
        $this->createParent($paymentMethod);
        return $paymentMethod;
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

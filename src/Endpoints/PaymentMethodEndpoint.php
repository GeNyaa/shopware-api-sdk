<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\PaymentMethod;
use GeNyaa\ShopwareApiSdk\Dto\Resources\PaymentMethodCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class PaymentMethodEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/payment-method';

    protected string $resource = 'payment_method';

    /**
     * @throws ShopwareApiException
     */
    public function all(): PaymentMethodCollection
    {
        return (new PaymentMethodCollection())->merge($this->restAll());
    }

    public function first(): ?PaymentMethod
    {
        $paymentMethod = $this->restFirst();

        return is_null($paymentMethod) ? null : $this->mapInto($paymentMethod);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(PaymentMethod $paymentMethod): PaymentMethod
    {
        $this->restCreate($paymentMethod);
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

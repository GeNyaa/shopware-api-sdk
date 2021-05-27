<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\Tax;
use GeNyaa\ShopwareApiSdk\Dto\Resources\TaxCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class TaxEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/tax';

    protected string $resource = 'tax';

    /**
     * @throws ShopwareApiException
     */
    public function all(): TaxCollection
    {
        return (new TaxCollection())->merge($this->restAll());
    }

    public  function first(): ?Tax
    {
        $tax = $this->restFirst();

        return is_null($tax) ? null : $this->mapInto($tax);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Tax $tax): Tax
    {
        $this->restCreate($tax);
        return $tax;
    }

    public function mapInto(array $tax): Tax
    {
        return new Tax(
            $tax['id'],
            $tax['name'],
            $tax['taxRate']
        );
    }
}

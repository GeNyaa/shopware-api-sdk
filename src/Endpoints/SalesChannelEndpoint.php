<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\Resources\SalesChannel;
use GeNyaa\ShopwareApiSdk\Dto\Resources\SalesChannelCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class SalesChannelEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/sales-channel';

    protected string $resource = 'sales_channel';

    /**
     * @throws ShopwareApiException
     */
    public function all(): SalesChannelCollection
    {
        return (new SalesChannelCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public  function first(): ?SalesChannel
    {
        $salesChannel = parent::first();

        return is_null($salesChannel) ? null : $this->mapInto($salesChannel);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(SalesChannel $salesChannel): SalesChannel
    {
        $this->restCreate($salesChannel);
        return $salesChannel;
    }

    public function mapInto(array $salesChannel): SalesChannel
    {
        return new SalesChannel(
            $salesChannel['id'],
            $salesChannel['name'],
        );
    }
}

<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Currency;
use GeNyaa\ShopwareApiSdk\Dto\SalesChannel;

class SalesChannelEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/sales-channel';

    protected string $resource = 'sales_channel';

    public  function first(): ?SalesChannel
    {
        $salesChannel = parent::first();

        return is_null($salesChannel) ? null : $this->mapInto($salesChannel);
    }

    public function mapInto(array $salesChannel): SalesChannel
    {
        return new SalesChannel(
            $salesChannel['id'],
            $salesChannel['name'],
        );
    }
}

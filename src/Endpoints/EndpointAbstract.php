<?php

declare(strict_types=1);


namespace ShopWorks\ShopwareApiSdk\Endpoints;


use Illuminate\Support\Collection;
use Response;
use ShopWorks\ShopwareApiSdk\Dto\Header;
use ShopWorks\ShopwareApiSdk\Dto\Parameters;
use ShopWorks\ShopwareApiSdk\Exceptions\ShopwareApiException;
use ShopWorks\ShopwareApiSdk\ShopwareApiClient;

abstract class EndpointAbstract
{
    protected string $resourcePath;

    public function __construct(
        protected ShopwareApiClient $client
    )
    {
    }

    /**
     * @throws ShopwareApiException
     */
    public function all(): array
    {
        $response = $this->client->performGetRequest(
            $this->resourcePath,
            new Parameters()
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response);
        }

        return $response->json();
    }
}
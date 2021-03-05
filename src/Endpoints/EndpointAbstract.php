<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use Illuminate\Support\Collection;
use Response;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

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
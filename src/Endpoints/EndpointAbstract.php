<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use Exception;
use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use Illuminate\Support\Collection;
use Response;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

abstract class EndpointAbstract implements EndpointInterface
{
    protected string $resourcePath;

    protected string $resource;

    public ?Parameters $parameters = null;

    public ?Header $header = null;

    public function __construct(
        protected ShopwareApiClient $client
    )
    {
    }

    public function parameters(Parameters $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function header(Header $header): self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @throws ShopwareApiException
     */
    public function all(): Collection
    {
        $response = $this->client->performGetRequest(
            $this->resourcePath,
            $this->parameters,
            $this->header,
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        if (is_null($response->json()['data'])) {
            return collect();
        }

        return collect($response->json()['data'])->map(function (array $data) {
            return $this->mapInto($data);
        });
    }

    public function first()
    {
        if (is_null($this->parameters)) {
            $this->parameters = new Parameters();
        }

        $parameters = $this->parameters->set('limit', 1);

        $response = $this->client->performGetRequest(
            $this->resourcePath,
            $parameters,
            $this->header,
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        return $response->json()['data'][0] ?? null;
    }

    public function upsert(Collection|Arrayable $upsertable): Collection|Arrayable
    {
        $return = $upsertable;

        if ($upsertable instanceof Collection) {
            $upsertable->map(function (Arrayable $arrayable) {
                return $arrayable->toArray();
            });

            $upsertable = $upsertable->toArray();
        }

        if ($upsertable instanceof Arrayable) {
            $upsertable = [$upsertable->toArray()];
        }


        $data = [
            sprintf('write-%s', $this->resource) => [
                'entity' => $this->resource,
                'action' => 'upsert',
                'payload' => $upsertable
            ]
        ];

        $response = $this->client->performSyncRequest($data, $this->header);

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        return $return;
    }
}

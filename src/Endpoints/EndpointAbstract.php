<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;

use GeNyaa\ShopwareApiSdk\Dto\DtoInterface;
use Illuminate\Support\Collection;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

abstract class EndpointAbstract implements EndpointInterface
{
    protected string $resourcePath;

    protected string $resource;

    protected ?Parameters $parameters = null;

    protected ?Header $header = null;

    abstract public function first();
    abstract public function all();

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
    protected function restAll(): Collection
    {
        $response = $this->client->performGetRequest(
            $this->resourcePath,
            $this->parameters,
            $this->header,
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        $data = $response->json();

        if (is_null($data['data'])) {
            return collect();
        }

        $return = collect($data['data'])->map(function (array $data) {
            return $this->mapInto($data);
        });

        while ($this->parameters->get('total-count-mode') === Parameters::COUNT_MODE_NEXT_PAGE && $data['total'] > 0) {
            $this->parameters->setPage($this->parameters->getPage() + 1);
            $response = $this->client->performGetRequest(
                $this->resourcePath,
                $this->parameters,
                $this->header,
            );

            if ($response->failed()) {
                throw new ShopwareApiException($response->body());
            }

            $data = $response->json();

            $return = $return->merge(
                collect($data['data'])->map(function (array $data) {
                    return $this->mapInto($data);
                })
            );
        }

        return $return;
    }

    /**
     * @throws ShopwareApiException
     */
    protected function restFirst()
    {
        if (is_null($this->parameters)) {
            $this->parameters = new Parameters();
        }

        $this->parameters->set('limit', 1);

        $response = $this->client->performGetRequest(
            $this->resourcePath,
            $this->parameters,
            $this->header,
        );

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        return $response->json()['data'][0] ?? null;
    }

    /**
     * @throws ShopwareApiException
     */
    public function upsert(Collection $upsertable): Collection
    {
        $data = [
            sprintf('write-%s', $this->resource) => [
                'entity' => $this->resource,
                'action' => 'upsert',
                'payload' => $upsertable->toArray(),
            ]
        ];

        $response = $this->client->performSyncRequest($data, $this->header);

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        return $upsertable;
    }

    /**
     * @throws ShopwareApiException
     */
    protected function restCreate(DtoInterface $resource): DtoInterface
    {
        $response = $this->client->performPostRequest($this->resourcePath, $resource->toArray(), $this->header);

        if ($response->failed()) {
            throw new ShopwareApiException($response->body());
        }

        return $resource;
    }
}

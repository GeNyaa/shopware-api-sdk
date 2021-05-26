<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use GeNyaa\ShopwareApiSdk\Dto\DtoAbstract;
use GeNyaa\ShopwareApiSdk\Dto\DtoInterface;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use Illuminate\Support\Collection;

interface EndpointInterface
{
    public function parameters(Parameters $parameters): self;
    public function header(Header $header): self;
    public function first();
    public function upsert(Collection $upsertable): Collection;
    public function mapInto(array $array);
}

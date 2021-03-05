<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use Illuminate\Contracts\Support\Arrayable as IArrayable;

interface Arrayable extends IArrayable
{
    public function toArray(): array;
}
<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use Stringable;

interface DtoInterface extends Arrayable, Jsonable
{
    public function __toString(): string;
}

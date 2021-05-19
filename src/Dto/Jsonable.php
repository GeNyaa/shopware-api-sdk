<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use \Illuminate\Contracts\Support\Jsonable as IJsonable;

interface Jsonable extends IJsonable
{
    public function toJson($options = 0): string;
}

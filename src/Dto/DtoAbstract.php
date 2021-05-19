<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


abstract class DtoAbstract implements DtoInterface
{
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}

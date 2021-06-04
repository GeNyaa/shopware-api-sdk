<?php

declare(strict_types=1);

use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Dto\Variables\CustomFields;
use GeNyaa\ShopwareApiSdk\Dto\Variables\Uuid;
use Illuminate\Support\Collection;

if (!function_exists('shopwareCollect')) {
    /**
     * Returns collection of resource.
     *
     * @param string $resource
     * @param mixed|null $value
     * @return mixed
     */
    function shopwareCollect(string $resource, mixed $value = null)
    {
        $resource = $resource . 'Collection';

        return new $resource($value);
    }
}

if (!function_exists('shopwareCustomFields')) {
    function shopwareCustomFields(?array $value = null): CustomFields
    {
        return new CustomFields($value);
    }
}

if (!function_exists('shopwareUuid')) {
    function shopwareUuid(): string
    {
        return Uuid::randomHex();
    }
}

if (!function_exists('shopwareParameters')) {
    function shopwareParameters(array $value = []): Parameters
    {
        return new Parameters($value);
    }
}

if (!function_exists('shopwareHeader')) {
    function shopwareHeader(array $value = []): Header
    {
        return new Header($value);
    }
}

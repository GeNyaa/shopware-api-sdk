# Laravel Shopware 6 API SDK

This package provides an SDK for Laravel to connect to Shopware 6 default API scheme.

This package is a WIP and will be updated on the main branch until stable.

# How to setup

Publish config file:

```bash
php artisan vendor:publish --provider="GeNyaa\ShopwareApiSdk\ShopwareApiSdkServiceProvider" --tag="config"
```

Initial client:
```php
$client = app(\GeNyaa\ShopwareApiSdk\ShopwareApiClient::class);
```

# Helper functions

### `shopwareCollect(string $resource, mixed $value = null)`

Creates a resource collection of Resource(s).

Example usage:
```php
use GeNyaa\ShopwareApiSdk\Dto\Resources\Category;

shopwareCollect(Category::class, []);
```

### `shopwareCustomFields(array $value = []): CustomFields`

Creates a CustomFields class from array.

Example usage:
```php
shopwareCustomFields([
    'fieldName' => 'fieldValue',
]);
```

### `shopwareParameters(array $value = []): Parameters`

Creates a Parameters class from array.

Example usage:
```php
shopwareParameters([
    'parameterName' => 'parameterValue',
]);
```

### `shopwareHeader(array $value = []): Header`

Creates a Header class from array.

Example usage:
```php
shopwareHeader([
    'headerName' => 'headerValue',
]);
```

### `shopwareUuid(): string`

Generates a Uuid to Shopware spec.

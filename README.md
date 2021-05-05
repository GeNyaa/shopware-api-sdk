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
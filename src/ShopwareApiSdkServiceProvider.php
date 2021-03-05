<?php

declare(strict_types=1);

namespace ShopWorks\ShopwareApiSdk;

use Illuminate\Support\ServiceProvider;
use ShopWorks\ShopwareApiSdk\Endpoints\EndpointAbstract;

class ShopwareApiSdkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shopware');
        $this->app->bind(EndpointAbstract::class, ShopwareApiClient::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shopware.php'),
            ], 'config');
        }
    }
}
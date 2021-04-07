<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use GeNyaa\ShopwareApiSdk\Endpoints\EndpointAbstract;

class ShopwareApiSdkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shopware');
        $this->app->bind(EndpointAbstract::class, ShopwareApiClient::class);
        $this->app->bind(ShopwareApiClient::class, function ($app) {
            return new ShopwareApiClient($app->make(Http::class));
        });
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
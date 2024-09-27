<?php

namespace IntelligentsDev\AiaConnector\Providers;

use Illuminate\Support\ServiceProvider;

class AiaConnectorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/aia.php', 'aia'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/aia.php' => config_path('aia.php'),
        ], 'aia-config');
    }
}

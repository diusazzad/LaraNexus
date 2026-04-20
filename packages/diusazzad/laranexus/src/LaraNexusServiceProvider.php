<?php

namespace Diusazzad\LaraNexus;

use Illuminate\Support\ServiceProvider;

class LaraNexusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laranexus.php', 'laranexus'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laranexus');

        // Publish Assets
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laranexus.php' => config_path('laranexus.php'),
            ], 'laranexus-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laranexus'),
            ], 'laranexus-views');
        }
    }
}

<?php

namespace Ecs\GmoPG\Providers;

use Illuminate\Support\ServiceProvider;

class GmoPGServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/../../config/gmopg.php', 'gmopg');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/gmopg.php' => config_path('gmopg.php'),
            __DIR__ . '/../../resources/lang/ja/gmopg-errors.php' => resource_path('lang/ja/gmopg-errors.php'),
        ], 'config');
    }
}

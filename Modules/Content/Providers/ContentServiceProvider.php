<?php

namespace Modules\Content\Providers;

use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Content', 'Config/config.php') => config_path('content.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Content', 'Config/config.php'), 'content'
        );
    }
} 
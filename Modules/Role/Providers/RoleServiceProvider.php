<?php

namespace Modules\Role\Providers;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
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
            module_path('Role', 'Config/config.php') => config_path('role.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Role', 'Config/config.php'), 'role'
        );
    }
} 
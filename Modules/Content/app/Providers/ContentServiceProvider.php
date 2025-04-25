<?php

namespace Modules\Content\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContentServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Content';
    protected string $moduleNameLower = 'content';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
        $this->registerRoutes();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register routes.
     */
    protected function registerRoutes(): void
    {
        Route::middleware('web')
            ->prefix($this->moduleNameLower)
            ->group(module_path($this->moduleName, 'routes/web.php'));

        Route::prefix('api')
            ->middleware('api')
            ->group(module_path($this->moduleName, 'routes/api.php'));
    }
} 
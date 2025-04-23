<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Http\Middleware\PermissionMiddleware;
use Illuminate\Routing\Router;

class AuthServiceProvider extends ServiceProvider
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
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path('Auth', 'Database/Migrations'));
        $this->registerMiddlewares();
    }

    /**
     * Register middlewares for this module.
     */
    public function registerMiddlewares()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Auth', 'Config/config.php') => config_path('auth.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Auth', 'Config/config.php'), 'auth'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/auth');

        $sourcePath = module_path('Auth', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/auth';
        }, \Config::get('view.paths')), [$sourcePath]), 'auth');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/auth');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'auth');
            $this->loadJsonTranslationsFrom($langPath, 'auth');
        } else {
            $this->loadTranslationsFrom(module_path('Auth', 'Resources/lang'), 'auth');
            $this->loadJsonTranslationsFrom(module_path('Auth', 'Resources/lang'), 'auth');
        }
    }
} 
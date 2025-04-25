<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModuleRouteProviders();
    }

    protected function registerModuleRouteProviders(): void
    {
        // Get all modules from the Modules directory
        $modulesPath = base_path('Modules');
        if (!is_dir($modulesPath)) {
            return;
        }
        
        $modules = array_diff(scandir($modulesPath), ['.', '..']);
        
        foreach ($modules as $module) {
            // Skip anything that's not a directory (e.g. README.md)
            $modulePath = $modulesPath . '/' . $module;
            if (!is_dir($modulePath)) {
                continue;
            }
            
            $routeProviderPath = $modulePath . '/app/Providers/RouteServiceProvider.php';
            
            if (file_exists($routeProviderPath)) {
                $providerClass = "Modules\\{$module}\\app\\Providers\\RouteServiceProvider";
                if (class_exists($providerClass)) {
                    $this->app->register($providerClass);
                }
            }
        }
    }
} 
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register module route service providers
        $this->registerModuleRouteProviders();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    
    /**
     * Register route service providers from each module
     */
    protected function registerModuleRouteProviders(): void
    {
        // Get all modules from the Modules directory
        $modulesPath = base_path('Modules');
        if (!is_dir($modulesPath)) {
            return;
        }
        
        $modules = array_diff(scandir($modulesPath), ['.', '..']);
        
        foreach ($modules as $module) {
            $routeProviderPath = $modulesPath . '/' . $module . '/app/Providers/RouteServiceProvider.php';
            
            if (file_exists($routeProviderPath)) {
                $providerClass = "Modules\\{$module}\\app\\Providers\\RouteServiceProvider";
                if (class_exists($providerClass)) {
                    $this->app->register($providerClass);
                }
            }
        }
    }
}

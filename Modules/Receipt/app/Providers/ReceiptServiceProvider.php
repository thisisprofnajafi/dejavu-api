<?php

namespace Modules\Receipt\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ReceiptServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Receipt';
    protected string $moduleNameLower = 'receipt';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
        $this->registerRoutes();
        $this->registerPermissions();
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

    /**
     * Register permissions for this module.
     */
    protected function registerPermissions(): void
    {
        // Create permissions if they don't exist
        $permissions = [
            'receipt.view',
            'receipt.create',
            'receipt.edit',
            'receipt.delete',
            'visitor.receipts.view',
            'visitor.commissions.view'
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        if ($adminRole = Role::where('name', 'admin')->first()) {
            $adminRole->givePermissionTo($permissions);
        }

        if ($visitorRole = Role::where('name', 'visitor')->first()) {
            $visitorRole->givePermissionTo([
                'receipt.view',
                'receipt.create',
                'visitor.receipts.view',
                'visitor.commissions.view'
            ]);
        }
    }
} 
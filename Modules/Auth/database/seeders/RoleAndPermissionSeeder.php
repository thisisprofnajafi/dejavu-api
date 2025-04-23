<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard permissions
            'view dashboard',
            
            // User management
            'list users',
            'create user',
            'edit user',
            'delete user',
            
            // Role management
            'list roles',
            'create role',
            'edit role',
            'delete role',
            
            // Permission management
            'list permissions',
            'assign permission',
            
            // Content management
            'list posts',
            'create post',
            'edit post',
            'delete post',
            'list categories',
            'create category',
            'edit category',
            'delete category',
            
            // Settings
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = config('auth.default_roles');
        
        foreach ($roles as $key => $roleData) {
            $role = Role::create(['name' => $key]);
            
            if ($key === 'admin') {
                // Give all permissions to admin
                $role->givePermissionTo(Permission::all());
            } else {
                // Assign specific permissions
                $permissionNames = $roleData['permissions'];
                $role->givePermissionTo($permissionNames);
            }
        }
    }
} 
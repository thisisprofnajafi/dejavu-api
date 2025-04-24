<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
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
            
            // Settings permissions
            'manage settings',
            
            // User permissions
            'view users',
            'manage users',
            
            // Role permissions
            'view roles',
            'manage roles',
            
            // Customer permissions
            'view customers',
            'manage customers',
            
            // FAQ permissions
            'view faqs',
            'manage faqs',
            
            // Ticket permissions
            'view tickets',
            'manage tickets',
            
            // Content permissions
            'view posts',
            'create posts',
            'edit own posts',
            'edit any post',
            'delete own posts',
            'delete any post',
            'view categories',
            'manage categories',
            'view pages',
            'manage pages',
            
            // Author permissions
            'view authors',
            'manage authors',
            
            // Payment permissions
            'view payments',
            'manage payments',
            
            // Wallet permissions
            'view wallet',
            'withdraw funds',
            
            // Receipt permissions
            'view receipts',
            'generate receipts',
            
            // Referral permissions
            'view referrals',
            'manage referrals'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin role
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
        
        // Author role
        $authorRole = Role::create(['name' => 'author']);
        $authorRole->givePermissionTo([
            'view dashboard',
            'view posts',
            'create posts',
            'edit own posts',
            'delete own posts',
            'view categories',
            'view receipts',
            'view wallet',
            'withdraw funds',
            'view referrals'
        ]);
        
        // Visitor role
        $visitorRole = Role::create(['name' => 'visitor']);
        $visitorRole->givePermissionTo([
            'view dashboard',
            'view wallet',
            'withdraw funds',
            'view receipts',
            'view referrals'
        ]);
    }
} 
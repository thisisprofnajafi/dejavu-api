<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDefaultPermissions();
        $this->createDefaultRoles();
        $this->assignPermissionsToRoles();
    }

    /**
     * Create default permissions.
     */
    private function createDefaultPermissions(): void
    {
        // Permissions for users
        $userPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        // Permissions for roles
        $rolePermissions = [
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
        ];

        // Permissions for permissions
        $permissionPermissions = [
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ];

        // Permissions for categories
        $categoryPermissions = [
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
        ];

        // Permissions for posts
        $postPermissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        // Permissions for stores
        $storePermissions = [
            'view stores',
            'create stores',
            'edit stores',
            'delete stores',
        ];

        // Permissions for resumes
        $resumePermissions = [
            'view resumes',
            'create resumes',
            'edit resumes',
            'delete resumes',
        ];

        // Permissions for plans
        $planPermissions = [
            'view plans',
            'create plans',
            'edit plans',
            'delete plans',
        ];

        // Permissions for faq
        $faqPermissions = [
            'view faqs',
            'create faqs',
            'edit faqs',
            'delete faqs',
        ];

        // Permissions for tickets
        $ticketPermissions = [
            'view tickets',
            'create tickets',
            'edit tickets',
            'delete tickets',
            'respond to tickets',
        ];

        // Permissions for customers
        $customerPermissions = [
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
        ];

        // Permissions for wallet
        $walletPermissions = [
            'view wallets',
            'create wallet transactions',
            'manage wallet',
        ];

        // Permissions for receipts
        $receiptPermissions = [
            'view receipts',
            'create receipts',
            'edit receipts',
            'delete receipts',
        ];

        // Merge all permissions
        $allPermissions = array_merge(
            $userPermissions,
            $rolePermissions,
            $permissionPermissions,
            $categoryPermissions,
            $postPermissions,
            $storePermissions,
            $resumePermissions,
            $planPermissions,
            $faqPermissions,
            $ticketPermissions,
            $customerPermissions,
            $walletPermissions,
            $receiptPermissions
        );

        // Create permissions if they don't exist
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create default roles if they don't exist.
     */
    private function createDefaultRoles(): void
    {
        $roles = ['admin', 'author', 'visitor', 'user', 'customer'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    /**
     * Assign permissions to roles.
     */
    private function assignPermissionsToRoles(): void
    {
        // Admin role - gets all permissions
        $adminRole = Role::where('name', 'admin')->first();
        $allPermissions = Permission::all();
        $adminRole->syncPermissions($allPermissions);

        // Author role - gets specific permissions
        $authorRole = Role::where('name', 'author')->first();
        $authorPermissions = Permission::whereIn('name', [
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view posts', 'create posts', 'edit posts', 'delete posts',
            'view tickets', 'create tickets',
        ])->get();
        $authorRole->syncPermissions($authorPermissions);

        // Visitor role - gets specific permissions
        $visitorRole = Role::where('name', 'visitor')->first();
        $visitorPermissions = Permission::whereIn('name', [
            'view wallets', 'create wallet transactions', 'manage wallet',
            'view receipts', 'create receipts',
            'view customers',
        ])->get();
        $visitorRole->syncPermissions($visitorPermissions);

        // User role - gets specific permissions
        $userRole = Role::where('name', 'user')->first();
        $userPermissions = Permission::whereIn('name', [
            'view tickets', 'create tickets',
        ])->get();
        $userRole->syncPermissions($userPermissions);

        // Customer role - gets specific permissions
        $customerRole = Role::where('name', 'customer')->first();
        $customerPermissions = Permission::whereIn('name', [
            'view tickets', 'create tickets',
        ])->get();
        $customerRole->syncPermissions($customerPermissions);
    }
}

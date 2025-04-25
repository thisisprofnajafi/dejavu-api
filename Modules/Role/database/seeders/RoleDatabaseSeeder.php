<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Role and Permission Seeder...');
        
        // Check if the required tables exist
        if (!Schema::hasTable('permissions')) {
            $this->command->info('Skipping Permission seeding: permissions table does not exist.');
        } else {
            try {
                $this->createDefaultPermissions();
                $this->command->info('Default permissions created successfully.');
            } catch (\Exception $e) {
                $this->command->error('Error creating default permissions: ' . $e->getMessage());
            }
        }
        
        if (!Schema::hasTable('roles')) {
            $this->command->info('Skipping Role seeding: roles table does not exist.');
        } else {
            try {
                $this->createDefaultRoles();
                $this->command->info('Default roles created successfully.');
            } catch (\Exception $e) {
                $this->command->error('Error creating default roles: ' . $e->getMessage());
            }
        }
        
        if (Schema::hasTable('roles') && Schema::hasTable('permissions') && Schema::hasTable('role_has_permissions')) {
            try {
                $this->assignPermissionsToRoles();
                $this->command->info('Permissions assigned to roles successfully.');
            } catch (\Exception $e) {
                $this->command->error('Error assigning permissions to roles: ' . $e->getMessage());
            }
        } else {
            $this->command->info('Skipping permission assignment: required tables do not exist.');
        }
    }

    /**
     * Create default permissions.
     */
    private function createDefaultPermissions(): void
    {
        // Permissions for users
        $userPermissions = [
            'مشاهده کاربران',
            'ایجاد کاربران',
            'ویرایش کاربران',
            'حذف کاربران',
        ];

        // Permissions for roles
        $rolePermissions = [
            'مشاهده نقش‌ها',
            'ایجاد نقش‌ها',
            'ویرایش نقش‌ها',
            'حذف نقش‌ها',
        ];

        // Permissions for permissions
        $permissionPermissions = [
            'مشاهده دسترسی‌ها',
            'ایجاد دسترسی‌ها',
            'ویرایش دسترسی‌ها',
            'حذف دسترسی‌ها',
        ];

        // Permissions for categories
        $categoryPermissions = [
            'مشاهده دسته‌بندی‌ها',
            'ایجاد دسته‌بندی‌ها',
            'ویرایش دسته‌بندی‌ها',
            'حذف دسته‌بندی‌ها',
        ];

        // Permissions for posts
        $postPermissions = [
            'مشاهده پست‌ها',
            'ایجاد پست‌ها',
            'ویرایش پست‌ها',
            'حذف پست‌ها',
        ];

        // Permissions for stores
        $storePermissions = [
            'مشاهده فروشگاه‌ها',
            'ایجاد فروشگاه‌ها',
            'ویرایش فروشگاه‌ها',
            'حذف فروشگاه‌ها',
        ];

        // Permissions for resumes
        $resumePermissions = [
            'مشاهده رزومه‌ها',
            'ایجاد رزومه‌ها',
            'ویرایش رزومه‌ها',
            'حذف رزومه‌ها',
        ];

        // Permissions for plans
        $planPermissions = [
            'مشاهده طرح‌ها',
            'ایجاد طرح‌ها',
            'ویرایش طرح‌ها',
            'حذف طرح‌ها',
        ];

        // Permissions for faq
        $faqPermissions = [
            'مشاهده سوالات متداول',
            'ایجاد سوالات متداول',
            'ویرایش سوالات متداول',
            'حذف سوالات متداول',
        ];

        // Permissions for tickets
        $ticketPermissions = [
            'مشاهده تیکت‌ها',
            'ایجاد تیکت‌ها',
            'ویرایش تیکت‌ها',
            'حذف تیکت‌ها',
            'پاسخ به تیکت‌ها',
        ];

        // Permissions for customers
        $customerPermissions = [
            'مشاهده مشتریان',
            'ایجاد مشتریان',
            'ویرایش مشتریان',
            'حذف مشتریان',
        ];

        // Permissions for wallet
        $walletPermissions = [
            'مشاهده کیف‌پول‌ها',
            'ایجاد تراکنش‌های کیف‌پول',
            'مدیریت کیف‌پول',
        ];

        // Permissions for receipts
        $receiptPermissions = [
            'مشاهده رسیدها',
            'ایجاد رسیدها',
            'ویرایش رسیدها',
            'حذف رسیدها',
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
            try {
                Permission::firstOrCreate(['name' => $permission]);
            } catch (\Exception $e) {
                $this->command->error("Error creating permission '{$permission}': " . $e->getMessage());
            }
        }
    }

    /**
     * Create default roles if they don't exist.
     */
    private function createDefaultRoles(): void
    {
        $roles = ['admin', 'author', 'visitor', 'user', 'customer'];

        foreach ($roles as $role) {
            try {
                Role::firstOrCreate(['name' => $role]);
                $this->command->info("Created or verified role: {$role}");
            } catch (\Exception $e) {
                $this->command->error("Error creating role '{$role}': " . $e->getMessage());
            }
        }
    }

    /**
     * Assign permissions to roles.
     */
    private function assignPermissionsToRoles(): void
    {
        // Admin role - gets all permissions
        try {
            $adminRole = Role::where('name', 'admin')->first();
            if (!$adminRole) {
                $this->command->error("Admin role not found, skipping permission assignment.");
                return;
            }
            
            $allPermissions = Permission::all();
            if ($allPermissions->isEmpty()) {
                $this->command->error("No permissions found to assign.");
                return;
            }
            
            $adminRole->syncPermissions($allPermissions);
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions to admin role: " . $e->getMessage());
        }

        // Author role - gets specific permissions
        try {
            $authorRole = Role::where('name', 'author')->first();
            if (!$authorRole) {
                $this->command->error("Author role not found, skipping permission assignment.");
                return;
            }
            
            $authorPermissions = Permission::whereIn('name', [
                'مشاهده دسته‌بندی‌ها', 'ایجاد دسته‌بندی‌ها', 'ویرایش دسته‌بندی‌ها', 'حذف دسته‌بندی‌ها',
                'مشاهده پست‌ها', 'ایجاد پست‌ها', 'ویرایش پست‌ها', 'حذف پست‌ها',
                'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
            ])->get();
            
            if ($authorPermissions->isEmpty()) {
                $this->command->error("No author permissions found to assign.");
                return;
            }
            
            $authorRole->syncPermissions($authorPermissions);
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions to author role: " . $e->getMessage());
        }

        // Visitor role - gets specific permissions
        try {
            $visitorRole = Role::where('name', 'visitor')->first();
            if (!$visitorRole) {
                $this->command->error("Visitor role not found, skipping permission assignment.");
                return;
            }
            
            $visitorPermissions = Permission::whereIn('name', [
                'مشاهده کیف‌پول‌ها', 'ایجاد تراکنش‌های کیف‌پول', 'مدیریت کیف‌پول',
                'مشاهده رسیدها', 'ایجاد رسیدها',
                'مشاهده مشتریان',
            ])->get();
            
            if ($visitorPermissions->isEmpty()) {
                $this->command->error("No visitor permissions found to assign.");
                return;
            }
            
            $visitorRole->syncPermissions($visitorPermissions);
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions to visitor role: " . $e->getMessage());
        }

        // User role - gets specific permissions
        try {
            $userRole = Role::where('name', 'user')->first();
            if (!$userRole) {
                $this->command->error("User role not found, skipping permission assignment.");
                return;
            }
            
            $userPermissions = Permission::whereIn('name', [
                'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
            ])->get();
            
            if ($userPermissions->isEmpty()) {
                $this->command->error("No user permissions found to assign.");
                return;
            }
            
            $userRole->syncPermissions($userPermissions);
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions to user role: " . $e->getMessage());
        }

        // Customer role - gets specific permissions
        try {
            $customerRole = Role::where('name', 'customer')->first();
            if (!$customerRole) {
                $this->command->error("Customer role not found, skipping permission assignment.");
                return;
            }
            
            $customerPermissions = Permission::whereIn('name', [
                'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
            ])->get();
            
            if ($customerPermissions->isEmpty()) {
                $this->command->error("No customer permissions found to assign.");
                return;
            }
            
            $customerRole->syncPermissions($customerPermissions);
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions to customer role: " . $e->getMessage());
        }
    }
}

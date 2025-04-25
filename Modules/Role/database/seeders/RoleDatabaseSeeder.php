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
            'مشاهده دسته‌بندی‌ها', 'ایجاد دسته‌بندی‌ها', 'ویرایش دسته‌بندی‌ها', 'حذف دسته‌بندی‌ها',
            'مشاهده پست‌ها', 'ایجاد پست‌ها', 'ویرایش پست‌ها', 'حذف پست‌ها',
            'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
        ])->get();
        $authorRole->syncPermissions($authorPermissions);

        // Visitor role - gets specific permissions
        $visitorRole = Role::where('name', 'visitor')->first();
        $visitorPermissions = Permission::whereIn('name', [
            'مشاهده کیف‌پول‌ها', 'ایجاد تراکنش‌های کیف‌پول', 'مدیریت کیف‌پول',
            'مشاهده رسیدها', 'ایجاد رسیدها',
            'مشاهده مشتریان',
        ])->get();
        $visitorRole->syncPermissions($visitorPermissions);

        // User role - gets specific permissions
        $userRole = Role::where('name', 'user')->first();
        $userPermissions = Permission::whereIn('name', [
            'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
        ])->get();
        $userRole->syncPermissions($userPermissions);

        // Customer role - gets specific permissions
        $customerRole = Role::where('name', 'customer')->first();
        $customerPermissions = Permission::whereIn('name', [
            'مشاهده تیکت‌ها', 'ایجاد تیکت‌ها',
        ])->get();
        $customerRole->syncPermissions($customerPermissions);
    }
}

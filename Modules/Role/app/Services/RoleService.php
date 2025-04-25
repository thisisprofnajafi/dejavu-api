<?php

namespace Modules\Role\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;

class RoleService
{
    /**
     * Get all roles with their permissions.
     *
     * @return Collection
     */
    public function getAllRoles(): Collection
    {
        return Role::with('permissions')->get();
    }

    /**
     * Get a role by ID with its permissions.
     *
     * @param int $id
     * @return Role|null
     */
    public function getRoleById(int $id): ?Role
    {
        return Role::with('permissions')->find($id);
    }

    /**
     * Create a new role with optional permissions.
     *
     * @param string $name
     * @param array $permissionIds
     * @return Role
     */
    public function createRole(string $name, array $permissionIds = []): Role
    {
        $role = Role::create(['name' => $name]);

        if (!empty($permissionIds)) {
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role->syncPermissions($permissions);
        }

        return $role->load('permissions');
    }

    /**
     * Update a role and its permissions.
     *
     * @param int $id
     * @param string $name
     * @param array $permissionIds
     * @return Role|null
     */
    public function updateRole(int $id, string $name, array $permissionIds = []): ?Role
    {
        $role = Role::find($id);

        if (!$role) {
            return null;
        }

        $role->name = $name;
        $role->save();

        if (!empty($permissionIds)) {
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role->syncPermissions($permissions);
        }

        return $role->load('permissions');
    }

    /**
     * Delete a role if it's not protected.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole(int $id): bool
    {
        $role = Role::find($id);

        if (!$role) {
            return false;
        }

        // Check if it's a protected role
        $protectedRoles = config('role.role.protected_roles', []);
        if (in_array($role->name, $protectedRoles)) {
            return false;
        }

        return $role->delete();
    }

    /**
     * Get all permissions.
     *
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        $cacheEnabled = config('role.cache.enabled', false);
        $cacheExpiration = config('role.cache.expiration', 60);

        if ($cacheEnabled) {
            return Cache::remember('all_permissions', $cacheExpiration * 60, function () {
                return Permission::all();
            });
        }

        return Permission::all();
    }

    /**
     * Get a permission by ID.
     *
     * @param int $id
     * @return Permission|null
     */
    public function getPermissionById(int $id): ?Permission
    {
        return Permission::find($id);
    }

    /**
     * Create a new permission.
     *
     * @param string $name
     * @return Permission
     */
    public function createPermission(string $name): Permission
    {
        $permission = Permission::create(['name' => $name]);

        // Clear cache if enabled
        if (config('role.cache.enabled', false)) {
            Cache::forget('all_permissions');
        }

        return $permission;
    }

    /**
     * Update a permission.
     *
     * @param int $id
     * @param string $name
     * @return Permission|null
     */
    public function updatePermission(int $id, string $name): ?Permission
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return null;
        }

        $permission->name = $name;
        $permission->save();

        // Clear cache if enabled
        if (config('role.cache.enabled', false)) {
            Cache::forget('all_permissions');
        }

        return $permission;
    }

    /**
     * Delete a permission if it's not protected.
     *
     * @param int $id
     * @return bool
     */
    public function deletePermission(int $id): bool
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return false;
        }

        // Check if it's a protected permission
        $protectedPermissions = config('role.permission.protected_permissions', []);
        if (in_array($permission->name, $protectedPermissions)) {
            return false;
        }

        $result = $permission->delete();

        // Clear cache if enabled
        if ($result && config('role.cache.enabled', false)) {
            Cache::forget('all_permissions');
        }

        return $result;
    }

    /**
     * Assign permissions to a role.
     *
     * @param int $roleId
     * @param array $permissionIds
     * @return Role|null
     */
    public function assignPermissionsToRole(int $roleId, array $permissionIds): ?Role
    {
        $role = Role::find($roleId);

        if (!$role) {
            return null;
        }

        $permissions = Permission::whereIn('id', $permissionIds)->get();
        $role->syncPermissions($permissions);

        return $role->load('permissions');
    }

    /**
     * Get all roles that have a specific permission.
     *
     * @param int $permissionId
     * @return Collection
     */
    public function getRolesWithPermission(int $permissionId): Collection
    {
        $permission = Permission::find($permissionId);

        if (!$permission) {
            return collect([]);
        }

        return $permission->roles;
    }
} 
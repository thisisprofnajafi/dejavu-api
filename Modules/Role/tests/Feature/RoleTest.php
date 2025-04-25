<?php

namespace Modules\Role\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $regularUser;
    protected $adminToken;
    protected $userToken;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles and permissions
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $viewRolesPermission = Permission::create(['name' => 'view roles']);
        $createRolesPermission = Permission::create(['name' => 'create roles']);
        $editRolesPermission = Permission::create(['name' => 'edit roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete roles']);

        // Assign permissions to admin role
        $adminRole->syncPermissions([
            $viewRolesPermission,
            $createRolesPermission,
            $editRolesPermission,
            $deleteRolesPermission
        ]);

        // Create users
        $this->adminUser = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $this->adminUser->assignRole('admin');

        $this->regularUser = User::factory()->create([
            'email' => 'user@example.com',
        ]);
        $this->regularUser->assignRole('user');

        // Generate tokens
        $this->adminToken = $this->adminUser->createToken('test-token')->plainTextToken;
        $this->userToken = $this->regularUser->createToken('test-token')->plainTextToken;
    }

    public function test_admin_can_view_all_roles()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->getJson('/api/v1/roles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'roles',
                ]
            ]);
    }

    public function test_admin_can_create_a_role()
    {
        $roleData = [
            'name' => 'editor',
            'permissions' => [],
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->postJson('/api/v1/roles', $roleData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'role',
                ]
            ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'editor',
        ]);
    }

    public function test_admin_can_update_a_role()
    {
        $role = Role::create(['name' => 'editor']);

        $updateData = [
            'name' => 'content-editor',
            'permissions' => [],
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->putJson('/api/v1/roles/' . $role->id, $updateData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'role',
                ]
            ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'content-editor',
        ]);
    }

    public function test_admin_can_delete_a_role()
    {
        $role = Role::create(['name' => 'temp-role']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->deleteJson('/api/v1/roles/' . $role->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Role deleted successfully',
            ]);

        $this->assertDatabaseMissing('roles', [
            'name' => 'temp-role',
        ]);
    }

    public function test_admin_cannot_delete_protected_role()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->deleteJson('/api/v1/roles/' . $adminRole->id);

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'Cannot delete system role',
            ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'admin',
        ]);
    }

    public function test_admin_can_assign_permissions_to_role()
    {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit posts']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->adminToken)
            ->postJson('/api/v1/roles/' . $role->id . '/permissions', [
                'permissions' => [$permission->id],
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'role',
                ]
            ]);

        $this->assertTrue($role->fresh()->hasPermissionTo('edit posts'));
    }

    public function test_regular_user_cannot_view_roles()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->userToken)
            ->getJson('/api/v1/roles');

        $response->assertStatus(403);
    }
} 
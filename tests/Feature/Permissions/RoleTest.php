<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTest extends TestCase
{
    // use RefreshDatabase;

    private Permission $permission;
    private Role $role;
    private User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->permission = Permission::updateOrCreate(['name' => 'test permission that will be given to role']);
        $this->role = Role::updateOrCreate(['name' => 'testRoleThatWillGetPermission']);
        $this->user = User::updateOrCreate(['name' => 'TestUser', 'email' => 'test@email.com', 'password' => 'password']);
    }

    public function testThatRoleGetsPermission()
    {
        $this->permission = Permission::where('id', $this->permission->id)->firstOrFail();
        $this->role = Role::where('id', $this->role->id)->firstOrFail();
        $this->role->givePermissionTo($this->permission);
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => $this->role->id,
            'permission_id' => $this->permission->id
        ]);
    }

    public function testThatUserGetsPermission()
    {
        $this->permission = Permission::where('id', $this->permission->id)->firstOrFail();
        $this->user = User::where('id', $this->user->id)->firstOrFail();
        $this->user->givePermissionTo($this->permission);
        $this->assertDatabaseHas('model_has_permissions', [
            'model_id' => $this->user->id,
            'permission_id' => $this->permission->id
        ]);
    }

    public function testThatUserGetsRole()
    {
        $this->role = Role::where('id', $this->role->id)->firstOrFail();
        $this->user = User::where('id', $this->user->id)->firstOrFail();
        $this->user->assignRole($this->role);
        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $this->user->id,
            'role_id' => $this->role->id
        ]);
    }
}

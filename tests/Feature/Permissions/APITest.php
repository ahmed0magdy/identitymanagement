<?php

namespace Tests\Feature\Permissions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class APITest extends TestCase
{
    // use RefreshDatabase;

    public function testIndexReturnsDataInValidFormat()
    {
        $this->json('get', 'api/roles')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                     [
                        'id',
                        'name',
                        'guard_name',
                        'created_at',
                        'updated_at'
                     ]
                        ]
        );
    }
    public function testRoleIsCreatedSuccessfully()
    {
        $this->withoutExceptionHandling();
        $role = ['name' => 'role test 5'];
        $payload =
         [
            'role' => $role['name'],
            'permissions' => 'test permission that will be given to role',
         ];
        $this->json('post', 'api/roles', $payload)
         ->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('roles', $role);
    }

    public function testRoleIsDeletedSuccessfully()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'roles to be']);

        $this->json('delete', "api/roles/$role->id")
         ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('roles', ['name' => 'roles to be']);
    }
}

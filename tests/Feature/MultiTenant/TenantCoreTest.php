<?php

namespace MultiTenant;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class TenantCoreTest extends TestCase
{
    public  function createTenant($id, $domain): \Illuminate\Testing\TestResponse
    {

        $username = Str::random(6);
        $password = Str::random(12);
        Artisan::call('migrate:fresh --env=testing');
        DB::statement("DROP DATABASE IF EXISTS tenant_{$id}");
        return $this->postJson('/api/create', [
         'id' => $id,
         'username' => $username,
         'password' => $password,
         'domain' => $domain,
        ]);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testThatTenantIsCreatable(): void
    {
        $id = "foo";
        $domain = "foo.localhost";
        $table = "domains";
        $response = $this->createTenant($id, $domain);
        $response->assertStatus(201);
        $this->assertDatabaseHas($table, ['domain' => $domain, 'tenant_id' => $id]);
    }
}

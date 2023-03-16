<?php

namespace MultiTenant;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class TenantCoreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testThatTenantIsCreatable(): void
    {
        $username = "test";
        $password = "SecretGamedAwe69@96";
        $id = "d1";
        $domain = "d1.localhost";
        $table = "domains";

        Artisan::call('migrate:fresh --env=testing');
        DB::statement("DROP DATABASE IF EXISTS tenant_{$id}");

        $response = $this->postJson('/api/create', [
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'domain' => $domain,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas($table, ['domain' => $domain, 'tenant_id' => $id]);
    }
}

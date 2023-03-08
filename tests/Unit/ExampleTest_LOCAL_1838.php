<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Http\Controllers\Controller;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_tenant_is_creatable(): void
    {

        $controller = new Controller();
        $username = Str::random(6);
        $password = Str::random(12);
        $id = "ahs";
        $domain = "ahs.localhost";   //Add tenant domain EX: d1.localhost
        $table = "domains";       //don't change table name !!
        Artisan::call('migrate:fresh --env=testing');
        DB::statement("DROP DATABASE IF EXISTS tenant_{$id}");
        $controller->CreateTenantWithUser($domain, $id, $username, $password);
        $this->assertDatabaseHas($table, ['domain' => $domain, 'tenant_id' => $id]);
        $response = $this->call('GET', 'http://' . $domain . ':8000/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}

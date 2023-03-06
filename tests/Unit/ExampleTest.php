<?php

namespace Tests\Unit;

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
        $username = "";         //Add tenant database username
        $password = "";        //Add database  password
        $id = "";                 //Add tenant database tenant id
        $domain = "";   //Add tenant domain EX: d1.localhost
        $table = "";       //don't change table name !!
        $controller->CreateTenantWithUser($domain, $id, $username, $password);
        $this->assertDatabaseHas($table, ['domain' => $domain, 'tenant_id' => $id]);
        $response = $this->call('GET', 'http://' . $domain . ':8000/');
        $this->assertEquals(200, $response->getStatusCode());
    }

}

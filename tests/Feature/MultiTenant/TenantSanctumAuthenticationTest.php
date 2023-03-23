<?php

namespace MultiTenant;

use App\Models\Tenant;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use MultiTenant\TenantCoreTest;

class TenantSanctumAuthenticationTest extends TestCase
{
    public function testThatLandlordAdminCanAuthenticate(): void
    {
        //sanctum acting as landlord admin
        Sanctum::actingAs(
            User::factory()->create(),
        );
        //get request to api/show
        $response = $this->get('/api');
        //assert response is ok
        $response->assertOk();
    }

    public function testThatTenantUserCanAuthenticate(): void
    {
        //get id from created tenant in (TenantCoreTest)
        $id = "foo";
        //get tenant object from database
        $tenant = Tenant::find($id);
        //run for foo tenant acting as tenant user
        $tenant->run(function () {
            Sanctum::actingAs(
                User::factory()->create(),
            );
        });
        //get request to api/show
        $response = $this->get('http://foo.localhost:8000/api');
        //assert response is ok
        $response->assertOk();
    }
}

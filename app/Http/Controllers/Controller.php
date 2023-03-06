<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    //function to create tenant with subdomain and user
    public function CreateTenantWithUser($domain, $id, $username, $password)
    {
        $tenant1 = Tenant::create([
            'id' => $id,
            'tenancy_db_username' => $username,
            'tenancy_db_password' => $password,
        ]);
        $tenant1->domains()->create(['domain' => $domain]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'client-view']);
        Permission::create(['name' => 'client-view-all']);
        Permission::create(['name' => 'client-edit']);
        Permission::create(['name' => 'client-delete']);
        Permission::create(['name' => 'client-create']);
        Permission::create(['name' => 'client-full-control']);
        Permission::create(['name' => 'client-grouping']);

        // create roles and assign created permissions
      //    $role = Role::create(['name' => 'Admin']);
      //    $role->givePermissionTo('full control client');
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'Admin@revixir.com';
        $admin->password = Hash::make('password');
        $admin->save();
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        $admin->assignRole('super-admin');
    }
}

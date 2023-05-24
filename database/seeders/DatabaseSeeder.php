<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            PermissionTableSeeder::class,
            CdTypesCdValuesSeeder::class,

        ]);
        \App\Models\Organization::factory(10)->create();
        \App\Models\Application::factory(10)->create();
        \App\Models\IdentifierDefinition::factory(10)->create();
        \App\Models\IdentifierIssuer::factory(10)->create();
        \App\Models\User::factory(1)->create();
    }
}

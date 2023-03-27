<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class LdapAuthenticationTest extends TestCase
{
    // use DatabaseMigrations;
    use WithFaker;

    protected function tearDown(): void
    {
        DirectoryEmulator::tearDown();

        parent::tearDown();
    }

    public function testAuthWorks()
    {
        $fake = DirectoryEmulator::setup();

        $ldapUser = LdapUser::create([
            'cn' => $this->faker->name,
            'mail' => $this->faker->email,
            'objectguid' => $this->faker->uuid,
        ]);

        $fake->actingAs($ldapUser);

        $this->post('/ldap', [
            'email' => $ldapUser->mail[0],
            'password' => 'secret',
        ]);

        $user = Auth::user();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($ldapUser->mail[0], $user->email);
        $this->assertEquals($ldapUser->cn[0], $user->name);
    }
}

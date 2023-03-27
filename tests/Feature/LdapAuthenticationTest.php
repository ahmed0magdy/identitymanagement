<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use Tests\TestCase;

class LdapAuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    protected function tearDown(): void
    {
        DirectoryEmulator::tearDown();

        parent::tearDown();
    }

    public function test_auth_works()
    {
        $fake = DirectoryEmulator::setup('default');

        $ldapUser = LdapUser::create([
            'cn' => $this->faker->name,
            'mail' => $this->faker->email,
            'guid' => $this->faker->uuid,
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

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;
use Tests\TestCase;

class LdapUserCannotAuthenticateWithInvalidPasswordTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;


    public function testLdapUserCannotAuthenticateWithInvalidPassword()
    {
        DirectoryEmulator::setup();

        $ldapUser = LdapUser::create([
            'cn' => 'John Doe',
            'mail' => 'john@local.com',
        ]);

        $this->postJson('ldap', [
            'email' => $ldapUser->mail[0],
            'password' => 'secret',
            'device_name' => 'browser',
        ])->assertJsonValidationErrors([
            'email' => 'The provided credentials are incorrect.'
        ]);

        // Ensure the user was not imported:
        $this->assertDatabaseMissing(User::class, [
            'email' => $ldapUser->mail[0],
            'name' => $ldapUser->cn[0],
        ]);
    }
}

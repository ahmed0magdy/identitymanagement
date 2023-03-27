<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class LdapUserCannotAuthenticateWithInvalidPasswordTest extends TestCase
{
    // use DatabaseMigrations;
    use WithFaker;

    protected function tearDown(): void
    {
        DirectoryEmulator::tearDown();

        parent::tearDown();
    }

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

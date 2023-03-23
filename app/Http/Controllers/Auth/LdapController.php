<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LdapController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Remember, an LDAP query will be executed on all the array
        // elements in the credentials array (excluding "password").
        // Here, we're locating a user via their "mail" attribute.
        $credentials = [
            'mail' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('ldap')->attempt($credentials)) {
            $user = Auth::guard('ldap')->getLastAttempted();

            User::UpdateOrcreate(
                ['email' => $user->email],
                [
                    'provider' => 'ldap',
                ]
            );
            Auth::login($user);

            return response()->json([
                "user-data" => $user,
                'status' => true,
                'message' => 'User Logged In Successfully',
                // 'token' => $user->createToken('ldap')->plainTextToken
            ], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}

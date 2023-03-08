<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthApiController extends Controller
{
    public function googleredirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googlecallaback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        // dd($googleUser);

        return response()->json(['userdata' => $googleUser]);

    // $user = User::updateOrCreate([
    //     'google_id' => $googleUser->id,
    // ], [
    //     'name' => $googleUser->name,
    //     'email' => $googleUser->email,
    //     'auth_type' ='google';
    //     'google_token' => $googleUser->token,
    //     'google_refresh_token' => $googleUser->refreshToken,
    // ]);

    // Auth::login($user);

    }
}

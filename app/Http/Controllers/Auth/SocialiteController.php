<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            if ($user) {
                $dbUser = User::UpdateOrcreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'provider' => $provider,
                        'password' => Hash::make(Str::random(10))
                        ]
                );
                    Auth::login($dbUser);

                return response()->json([
                    "user-data" => $dbUser,
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                ], 200);
            } else {
                return response()->json(['error' => 'Invalid credentials provided.'], 422);
            }
        } catch (Exception $exception) {
            return response()->json([$exception->getMessage()]);
        }
    }
}

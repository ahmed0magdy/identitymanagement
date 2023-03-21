<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;

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
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

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
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $userProvider = Socialite::driver($provider)->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        // $user = User::where('email', $userProvider->email)->first();
        $user = User::firstOrCreate(
            [
                'email' => $userProvider->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $userProvider->getName(),
                'status' => true,
            ]
        );

        return response()->json([
            "user-data" => $user,
            'status' => true,
            'message' => 'User Logged In Successfully',
            // 'token' => $user->createToken($provider)->plainTextToken
        ], 200);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google'])) {
            return response()->json(['error' => 'Please login using google'], 422);
        }
    }
}

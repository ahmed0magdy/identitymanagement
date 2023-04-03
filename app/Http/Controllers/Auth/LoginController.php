<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(Request $request)
{
    $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validator->errors(),
        ], 401);
    }

    $credentials = $request->only(['email', 'password']);
    if (!Auth::attempt($credentials)) {
        return response()->json([
            'status' => false,
            'message' => 'Email & Password do not match our records.',
        ], 401);
    }

    $user = Auth::user();
    $user->provider = 'basic';
    $user->save();

    $request->session()->regenerate(); // session fixation

    return response()->json([
        'message' => 'Successfully logged in',
        'user' => $user,
    ]);
}


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'user logged out']);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // try {
        //     $validateUser = Validator::make(
        //         $request->all(),
        //         [
        //             'email' => 'required|email',
        //             'password' => 'required'
        //         ]
        //     );

        //     if ($validateUser->fails()) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'validation error',
        //             'errors' => $validateUser->errors()
        //         ], 401);
        //     }

        //     if (!Auth::attempt($request->only(['email', 'password']))) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Email & Password does not match with our record.',
        //         ], 401);
        //     }
        // $user = User::where('email', $request->email)->first();

        // $request->session()->regenerate(); //session fixation

        // return response()->json([
        //     'message' => 'Successfully logged in',
        //     'user' => Auth::user(),
        // ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Successfully logged in',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Email & Password does not match with our record.',
        ], 401);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'User Logged In Successfully',
        //     'token' => $user->createToken("API TOKEN")->plainTextToken
        // ], 200);

        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }

    // public function logout()
    // {
    //     auth()->user()->tokens()->delete();
    //     return [
    //         'message' => 'user logged out'
    //     ];

    // }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'user logged out']);
    }
}

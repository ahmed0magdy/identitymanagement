<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Auth\LdapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return "hello";
});

Route::post('/create', [TenantController::class,'store']);

Route::middleware('web')->post('login', [LoginController::class,'login']);

Route::get('/auth/{provider}/redirect', [SocialiteController::class,'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class,'handleProviderCallback']);


Route::post('/login/ldap', [LdapController::class,'login']);
// Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,'logout']);
Route::middleware('auth:sanctum','api')->post('logout', [LoginController::class,'logout']);
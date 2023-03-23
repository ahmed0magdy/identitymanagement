<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LdapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return 'hello web';
});
Route::middleware('auth:sanctum')->get('/get', function () {
    return 'hello web';
});

Route::post('login', [LoginController::class, 'login']);
Route::post('ldap', [LdapController::class, 'login']);
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::middleware('auth:sanctum')->post('logout', [LoginController::class, 'logout']);

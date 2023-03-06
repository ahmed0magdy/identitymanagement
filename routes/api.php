<?php

use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['auth']], function()
// {
//     Route::resource('roles', RoleController::class);
//     });

Route::resource('roles', RoleController::class);

Route::get('permissionsToRole/{id}',[RoleController::class,'assginPermissionsToRole']);
Route::get('permissionsToUser/{id}',[RoleController::class,'assginPermissionsToUser']);
Route::get('RolesToUser/{id}',[RoleController::class,'assginRolesToUser']);
Route::get('permissions',[RoleController::class,'getallPermissions']);
Route::get('permissions/{id}',[RoleController::class,'getUserPermissions']);


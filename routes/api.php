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

Route::post('permissionsToRole/{role}',[RoleController::class,'assignPermissionsToRole']);
Route::post('permissionsToUser/{user}',[RoleController::class,'assignPermissionsToUser']);
Route::post('RolesToUser/{user}',[RoleController::class,'assignRolesToUser']);
Route::get('permissions',[RoleController::class,'getAllPermissions']);
Route::get('permissions/{user}',[RoleController::class,'getUserPermissions']);

Route::post('removeUserRoles/{user}',[RoleController::class,'removeUserRole']);
Route::post('removeUserPermissions/{user}',[RoleController::class,'removeUserPermissions']);
Route::post('removeRolePermissions/{role}',[RoleController::class,'removeRolePermissions']);




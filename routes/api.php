<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Auth\LdapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CdTypeController;
use App\Http\Controllers\RoleController;

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

####Getting endpoints####
Route::get('roles', [RoleController::class, 'index']);
Route::get('permissions/{role}', [RoleController::class, 'show']);

Route::get('permissions', [RoleController::class, 'getAllPermissions']);
Route::get('permissions/user/{user}', [RoleController::class, 'getUserPermissions']);
Route::get('user/roles/{user}', [RoleController::class, 'getUserRoles']);
Route::get('user/role/{role}', [RoleController::class, 'getUsersWithGivenRole']);
Route::get('user/permission/{permission}', [RoleController::class, 'getUsersWithGivenPermission']);

####Assigning endpoints####
Route::post('roles', [RoleController::class, 'store']);
Route::post('roles/update', [RoleController::class, 'update']); // getting all data in request instead of uri

Route::post('permissions/role', [RoleController::class, 'assignPermissionsToRole']);
Route::post('permissions/user', [RoleController::class, 'assignPermissionsToUser']);
Route::post('roles/user', [RoleController::class, 'assignRolesToUser']);

####Check if endpoints####
Route::get('users/permissions/{user}/{permission}', [RoleController::class, 'UserHasPermission']);
Route::get('users/roles/{user}/{role}', [RoleController::class, 'UserHasRole']);
Route::get('roles/permissions/{role}/{permission}', [RoleController::class, 'RoleHasPermission']);

####Removing endpoints####
Route::delete('roles/{role}', [RoleController::class, 'destroy']);

Route::post('user/role', [RoleController::class, 'removeUserRole']);
Route::post('user/permission', [RoleController::class, 'removeUserPermissions']);
Route::post('role/permission', [RoleController::class, 'removeRolePermissions']);

####Tenant endpoints####
Route::post('/create', [TenantController::class,'store']);

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to revixir',
    ]);
});

######CdType endpoints #######

Route::get('/cdtypes', [CdTypeController::class,'getAllCdTypes']);
Route::get('/cdtypes/{cdType}', [CdTypeController::class,'getCdTypeById']);


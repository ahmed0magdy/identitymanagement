<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

//override sanctum's csrf-cookie route to use tenancy initialization middleware
Route::prefix('sanctum')->middleware([
            'web','universal',
            InitializeTenancyByDomain::class // Use tenancy initialization middleware of your choice
        ])->group(function () {
            Route::get('/csrf-cookie', [CsrfCookieController::class, 'show'])->name('sanctum.csrf-cookie');
        });

//universal auth routes for tenant and central domains (e.g. login, logout)
Route::prefix('api')->middleware([
    'universal',
    InitializeTenancyByDomain::class,
])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware(['web']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum','api']);
});

//tenant routes guarded by sanctum (only access by tenants)
Route::prefix('api')->middleware([
    'api','auth:sanctum',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});

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
Route::group(['prefix' => config('sanctum.prefix', 'sanctum')], static function () {
    Route::get('/csrf-cookie', [CsrfCookieController::class, 'show'])
        ->middleware([
            'api',
            InitializeTenancyByDomain::class // Use tenancy initialization middleware of your choice
        ])->name('sanctum.csrf-cookie');
});
//universal auth routes for tenant and central domains (e.g. login, logout)
Route::prefix('api')->middleware([
    'universal',
    InitializeTenancyByDomain::class,
])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

//tenant-only routes guarded by sanctum
Route::prefix('api')->group(function () {
    Route::middleware([
        'auth:sanctum',
        InitializeTenancyByDomain::class, // Use tenancy initialization middleware of your choice
        PreventAccessFromCentralDomains::class, // Prevent access to central domains
    ])->group(function () {
        Route::get('/get', function () {
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        });
    });
});


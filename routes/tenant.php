<?php

declare(strict_types=1);

use App\Http\Controllers\Api\TenantController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return response()->json([
        'message' => 'Tenant API is working',
        'tenant_id' => tenant('id'),
        'tenant_data' => tenant()
    ]);
});

Route::get('/profile', function () {
    return response()->json([
        'tenant_id' => tenant('id'),
        'tenant_data' => tenant()
    ]);
});

Route::apiResource('tenants', TenantController::class);

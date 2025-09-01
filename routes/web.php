<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/tenants', [App\Http\Controllers\Api\TenantController::class, 'index']);
    Route::post('/tenants', [App\Http\Controllers\Api\TenantController::class, 'store']);
    Route::get('/tenants/{tenant}', [App\Http\Controllers\Api\TenantController::class, 'show']);
    Route::put('/tenants/{tenant}', [App\Http\Controllers\Api\TenantController::class, 'update']);
    Route::delete('/tenants/{tenant}', [App\Http\Controllers\Api\TenantController::class, 'destroy']);
});

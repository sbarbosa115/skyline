<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        
        Route::middleware(['is.administrator'])->group(function () {
            Route::apiResource('users', \App\Http\Controllers\UserController::class);
            Route::apiResource('properties', \App\Http\Controllers\PropertyController::class);
            Route::apiResource('sub-properties', \App\Http\Controllers\SubPropertyController::class);
            Route::apiResource('contracts', \App\Http\Controllers\ContractsController::class);
            Route::apiResource('properties-services', \App\Http\Controllers\PropertiesServicesController::class);
        });

        Route::apiResource('bills', \App\Http\Controllers\BillsController::class);
    });

    Route::apiResource('work-orders', \App\Http\Controllers\WorkOrdersController::class);
    Route::post('/bills/{id}/upload-image', [\App\Http\Controllers\BillsController::class, 'uploadImage']);
});

<?php

use Core\Features\Appointment\Http\Controllers\Api\V1\AppointmentController;
use Core\Features\Auth\Http\Controllers\Auth\Api\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('appointments', AppointmentController::class);
    });
});

Route::middleware('guest')->post('/login', [AuthenticatedSessionController::class, 'store']);

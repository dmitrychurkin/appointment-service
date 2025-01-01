<?php

declare(strict_types=1);

use AppointmentService\Appointment\Http\Controllers\Api\V1\AppointmentController;
use AppointmentService\Appointment\Http\Controllers\Api\V1\AvailabilityController;
use AppointmentService\Common\Facades\Route;

Route::prefix('api/v1')->middleware('api')->group(function () {
    Route::apiResource('appointments', AppointmentController::class)
        ->only('store')
        ->middleware('auth:sanctum');

    Route::get('availability/slots', [AvailabilityController::class, 'slots'])
        ->middleware('auth:sanctum');
    Route::apiResource('availability', AvailabilityController::class)
        ->only('index')
        ->middleware('auth:sanctum');
});

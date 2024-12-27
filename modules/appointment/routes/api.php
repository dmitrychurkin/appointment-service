<?php

declare(strict_types=1);

use AppointmentService\Appointment\Http\Controllers\Api\V1\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->middleware('api')->group(function () {
    Route::apiResource('appointments', AppointmentController::class)
        ->middleware('auth:sanctum');
});

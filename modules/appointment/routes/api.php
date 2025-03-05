<?php

declare(strict_types=1);

use AppointmentService\Appointment\Http\Controllers\Api\V1\AppointmentController;
use AppointmentService\Appointment\Http\Controllers\Api\V1\AvailabilityController;
use AppointmentService\Common\Facades\Route;

Route::prefix(config('appointment.prefix'))
    ->name(config('appointment.name'))
    ->middleware(config('appointment.middleware'))
    ->group(function () {
        Route::apiResource('', AppointmentController::class)
            ->only('store');

        Route::get('availability/slots', [AvailabilityController::class, 'slots'])
            ->name('availability.slots');
        Route::apiResource('availability', AvailabilityController::class)
            ->only('index');
    });

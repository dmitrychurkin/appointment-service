<?php

use App\Http\Controllers\Api\V1\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('appointments', AppointmentController::class);

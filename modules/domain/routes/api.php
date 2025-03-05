<?php

declare(strict_types=1);

use AppointmentService\Common\Facades\Route;
use AppointmentService\Common\Http\Requests\Request;
use AppointmentService\Domain\Http\Controllers\Api\V1\AccountDomainController;
use AppointmentService\Domain\Http\Middleware\BrowserFingerprint;

Route::prefix(config('domain.prefix'))
    ->name(config('domain.name'))
    ->middleware(config('domain.middleware'))
    ->group(fn () => (
        Route::match(Request::METHOD_HEAD, '', AccountDomainController::class)
            ->name('initialize')
            ->middleware(BrowserFingerprint::class)
    ));

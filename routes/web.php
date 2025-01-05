<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

if (app()->isLocal()) {
    Route::get('/', fn () => ['Laravel' => app()->version()]);
    Route::get('/phpinfo', fn () => phpinfo());
}

require __DIR__.'/auth.php';

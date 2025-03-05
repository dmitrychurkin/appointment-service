<?php

declare(strict_types=1);

return [
    'name' => 'appointments.',
    'prefix' => 'api/v1/appointments',
    'middleware' => ['api', 'auth:sanctum'],
];

<?php

namespace Core\Features\Appointment\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

trait Uuids
{
    use HasUuids;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}

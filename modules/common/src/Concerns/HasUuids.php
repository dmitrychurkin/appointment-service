<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUuids as EloquentHasUuids;

trait HasUuids
{
    use EloquentHasUuids;
}

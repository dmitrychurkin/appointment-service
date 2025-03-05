<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUlids as EloquentHasUlids;

trait HasUlids
{
    use EloquentHasUlids;
}

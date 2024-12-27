<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes;

trait SoftDeletes
{
    use EloquentSoftDeletes;
}

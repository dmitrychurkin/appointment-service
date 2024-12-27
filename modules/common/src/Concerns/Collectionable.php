<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use Illuminate\Support\Collection;

trait Collectionable
{
    public function toCollection(): Collection
    {
        return collect([$this]);
    }
}

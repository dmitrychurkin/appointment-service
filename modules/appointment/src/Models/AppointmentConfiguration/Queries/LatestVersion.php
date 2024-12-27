<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Queries;

trait LatestVersion
{
    public function latestVersion(): self
    {
        return $this->orderByDesc('version');
    }
}

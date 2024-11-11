<?php

namespace Core\Features\Appointment\Models\AppointmentConfiguration\Queries;

trait LatestVersion
{
    public function latestVersion(): self
    {
        return $this->orderByDesc('version');
    }
}

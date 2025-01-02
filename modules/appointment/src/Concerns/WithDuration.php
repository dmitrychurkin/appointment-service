<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns;

trait WithDuration
{
    public function getDuration(): int
    {
        return $this->duration;
    }
}

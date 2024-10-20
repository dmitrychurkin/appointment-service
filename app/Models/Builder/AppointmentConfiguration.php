<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Builder;

final class AppointmentConfiguration extends Builder
{
    public function latestVersion(): self
    {
        return $this->orderByDesc('version');
    }
}

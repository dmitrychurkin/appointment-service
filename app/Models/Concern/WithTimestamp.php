<?php

namespace App\Models\Concern;

use Carbon\CarbonImmutable;
use DateTime;

trait WithTimestamp
{
    public CarbonImmutable $created_at;

    public DateTime $updated_at;
}

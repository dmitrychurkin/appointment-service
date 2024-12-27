<?php

declare(strict_types=1);

namespace AppointmentService\Common\Factories;

use AppointmentService\Common\Contracts\Factory;
use AppointmentService\Common\Data\Data;

abstract class DataFactory extends Data implements Factory
{
    abstract public function make();
}

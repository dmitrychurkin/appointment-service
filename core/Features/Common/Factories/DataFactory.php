<?php

namespace Core\Features\Common\Factories;

use Core\Features\Common\Contracts\Factory;
use Core\Features\Common\Data\Data;

abstract class DataFactory extends Data implements Factory
{
    abstract public function make();
}

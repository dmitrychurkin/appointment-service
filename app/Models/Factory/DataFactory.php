<?php

namespace App\Models\Factory;

use App\Models\Contract\Factory;
use Spatie\LaravelData\Data;

abstract class DataFactory extends Data implements Factory
{
    abstract public function make();
}

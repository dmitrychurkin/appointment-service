<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

trait MergeFillable
{
    public function __construct(array ...$params)
    {
        $this->mergeFillable(parent::$fillable);

        parent::__construct(...$params);
    }
}

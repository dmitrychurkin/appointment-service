<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use InvalidArgumentException;

trait Castable
{
    public function castTo($class)
    {
        if (! is_subclass_of($class, self::class)) {
            throw new InvalidArgumentException("{$class} must extend ".self::class);
        }

        $instance = (new $class)->setRawAttributes($this->getAttributes(), true);

        foreach ($this->getRelations() as $relation => $value) {
            $instance->setRelation($relation, $value);
        }

        $instance->exists = $this->exists;

        return $instance;
    }
}

<?php

declare(strict_types=1);

namespace AppointmentService\Common\Attributes;

use AppointmentService\Common\Contracts\ContextualAttribute;
use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
final class CurrentUser implements ContextualAttribute
{
    /**
     * Create a new attribute instance.
     */
    public function __construct(
        private readonly string $castTo
    ) {}

    /**
     * Resolve the configuration value.
     *
     *
     * @return mixed
     */
    public static function resolve(self $attribute)
    {
        return auth()->user()->castTo($attribute->castTo);
    }
}

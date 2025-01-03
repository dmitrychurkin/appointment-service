<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Attributes;

use AppointmentService\Appointment\Models\User\User;
use AppointmentService\Common\Contracts\ContextualAttribute;
use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
final class CurrentUser implements ContextualAttribute
{
    /**
     * Resolve the configuration value.
     */
    public static function resolve(): User
    {
        return auth()->user()->castTo(User::class);
    }
}

<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Attributes;

use AppointmentService\Appointment\Models\User\User;
use AppointmentService\Common\Contracts\Container\ContextualAttribute;
use Attribute;
use Illuminate\Contracts\Container\Container;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class CurrentUser implements ContextualAttribute
{
    /**
     * Resolve the configuration value.
     */
    public static function resolve(self $attribute, Container $container): User
    {
        return auth()->user()->castTo(User::class);
    }
}

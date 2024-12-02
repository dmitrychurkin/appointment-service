<?php

namespace Core\Features\Appointment\Attributes;

use Attribute;
use Core\Features\Appointment\Models\User\User;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Container\ContextualAttribute;

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

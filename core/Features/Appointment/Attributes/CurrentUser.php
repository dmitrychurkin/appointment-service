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
        $authenticated = auth()->user();

        $user = (new User)->setRawAttributes($authenticated->getAttributes(), true);

        $user->exists = $authenticated->exists;

        return $user;
    }
}

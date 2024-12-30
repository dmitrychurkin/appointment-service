<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Attributes;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Common\Contracts\ContextualAttribute;
use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
final class CurrentAccount implements ContextualAttribute
{
    /**
     * Resolve the configuration value.
     */
    public static function resolve(): Account
    {
        return CurrentUser::resolve()->account;
    }
}

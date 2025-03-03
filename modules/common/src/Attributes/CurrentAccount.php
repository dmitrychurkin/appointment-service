<?php

declare(strict_types=1);

namespace AppointmentService\Common\Attributes;

use AppointmentService\Common\Contracts\ContextualAttribute;
use AppointmentService\Common\Models\Account;
use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
final class CurrentAccount implements ContextualAttribute
{
    /**
     * Create a new attribute instance.
     */
    public function __construct(
        private readonly string $castTo = Account::class,
        private readonly string $forignKey = 'account_id'
    ) {}

    /**
     * Resolve the configuration value.
     *
     *
     * @return mixed
     */
    public static function resolve(self $attribute)
    {
        $forignKey = $attribute->forignKey;
        $user = auth()->user();

        return $attribute->castTo::find($user->{$forignKey});
    }
}

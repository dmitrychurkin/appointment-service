<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\User;

use AppointmentService\Common\Concerns\MergeFillable;
use AppointmentService\Common\Models\User as UserModel;

final class User extends UserModel
{
    use MergeFillable, UserRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'timezone',
    ];
}

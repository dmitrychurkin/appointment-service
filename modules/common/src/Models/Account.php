<?php

declare(strict_types=1);

namespace AppointmentService\Common\Models;

use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Concerns\SoftDeletes;

abstract class Account extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}

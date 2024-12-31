<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Appointment;

use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Concerns\SoftDeletes;
use AppointmentService\Common\Models\Model;

final class Appointment extends Model
{
    use AppointmentRelations, HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start',
        'end',
        'title',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start' => 'immutable_datetime',
            'end' => 'immutable_datetime',
        ];
    }
}

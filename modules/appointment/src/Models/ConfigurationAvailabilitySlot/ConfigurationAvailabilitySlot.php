<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Collections\ConfigurationAvailabilitySlotCollection;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Scopes\ConfigurationAvailabilitySlotOrderScope;
use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([ConfigurationAvailabilitySlotOrderScope::class])]
final class ConfigurationAvailabilitySlot extends Model
{
    use ConfigurationAvailabilitySlotRelations, HasFactory, HasUuids;

    /**
     * The Eloquent collection class to use for the model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Collection<*, *>>
     */
    protected static string $collectionClass = ConfigurationAvailabilitySlotCollection::class;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'date',
        'day_of_week',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'date' => 'immutable_date',
        ];
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['id'];
    }
}

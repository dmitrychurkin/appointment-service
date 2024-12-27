<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Appointment\Concerns\WithSlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Common\Concerns\Collectionable;
use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Override;

#[ObservedBy(AppointmentAvailabilitySlotObserver::class)]
final class AppointmentAvailabilitySlot extends Model implements Slot
{
    use AppointmentAvailabilitySlotAttributes, AppointmentAvailabilitySlotMutations, Collectionable, HasFactory, HasUuids, WithSlot;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'availability_slots';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
            'start' => 'datetime',
            'end' => 'datetime',
            'date' => 'date',
        ];
    }

    #[Override]
    public function newEloquentBuilder($query): AppointmentAvailabilitySlotBuilder
    {
        return new AppointmentAvailabilitySlotBuilder($query);
    }
}

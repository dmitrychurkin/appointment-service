<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot;

use Core\Features\Appointment\Concerns\WithSlot;
use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Common\Concerns\Collectionable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

#[ObservedBy(AppointmentAvailabilitySlotObserver::class)]
final class AppointmentAvailabilitySlot extends Model implements AppointmentSlot
{
    use AppointmentAvailabilitySlotAttributes, AppointmentAvailabilitySlotMutations, Collectionable, HasFactory, HasUuids, WithSlot;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start',
        'end',
        'date',
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
            'date' => 'immutable_date',
        ];
    }

    #[Override]
    public function newEloquentBuilder($query): AppointmentAvailabilitySlotBuilder
    {
        return new AppointmentAvailabilitySlotBuilder($query);
    }
}

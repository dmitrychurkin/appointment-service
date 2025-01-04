<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use AppointmentService\Appointment\Models\AppointmentConfiguration\Scopes\AppointmentConfigurationOrderScope;
use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Support\Collection;
use Override;

#[ScopedBy([AppointmentConfigurationOrderScope::class])]
final class AppointmentConfiguration extends Model
{
    use AppointmentConfigurationQueries, AppointmentConfigurationRelations, HasFactory, HasUuids;

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
        'version',
        'appointments_per_day',
        'next_appointment_threshold_minutes',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'version' => 1,
        'next_appointment_threshold_minutes' => 15,
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['id'];
    }

    public function getConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): Collection
    {
        return $this->whereConfigurationAvailabilitySlots($date)->get();
    }

    #[Override]
    public function newEloquentBuilder($query): AppointmentConfigurationBuilder
    {
        return new AppointmentConfigurationBuilder($query);
    }
}

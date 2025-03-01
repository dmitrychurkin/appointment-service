<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use AppointmentService\Appointment\Models\AppointmentConfiguration\Scopes\AppointmentConfigurationOrderScope;
use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Override;

#[ScopedBy([AppointmentConfigurationOrderScope::class])]
final class AppointmentConfiguration extends Model
{
    use AppointmentConfigurationMethods, AppointmentConfigurationQueries, AppointmentConfigurationRelations, HasFactory, HasUuids;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['configurationRecurrence'];

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

    #[Override]
    public function newEloquentBuilder($query): AppointmentConfigurationBuilder
    {
        return new AppointmentConfigurationBuilder($query);
    }
}

<?php

namespace Core\Features\Appointment\Models\AppointmentConfiguration;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

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

    #[Override]
    public function newEloquentBuilder($query): AppointmentConfigurationBuilder
    {
        return new AppointmentConfigurationBuilder($query);
    }
}

<?php

namespace App\Models;

use App\Models\Builder\AppointmentConfiguration as AppointmentConfigurationBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Lift;

#[HasMany(ConfigurationAvailabilitySlot::class)]
#[BelongsTo(Account::class)]
class AppointmentConfiguration extends Model
{
    use HasFactory, HasUuids, Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id;

    #[Column(default: 1)]
    public int $version;

    #[Column(name: 'appointments_per_day')]
    public ?int $appointmentsPerDay;

    #[Column(name: 'next_appointment_threshold_minutes', default: 15)]
    public int $nextAppointmentThresholdMinutes;

    #[Override]
    public function newEloquentBuilder($query): AppointmentConfigurationBuilder
    {
        return new AppointmentConfigurationBuilder($query);
    }
}

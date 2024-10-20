<?php

namespace App\Models;

use App\Models\Scope\ConfigurationAvailabilitySlotOrderScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Lift;

#[ScopedBy(ConfigurationAvailabilitySlotOrderScope::class)]
#[BelongsTo(AppointmentConfiguration::class)]
class ConfigurationAvailabilitySlot extends Model
{
    use HasFactory, HasUuids, Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id;

    #[Fillable]
    #[Column(name: 'start_time')]
    #[Cast('datetime:H:i')]
    public Carbon $startTime;

    #[Fillable]
    #[Column(name: 'end_time')]
    #[Cast('datetime:H:i')]
    public Carbon $endTime;

    #[Fillable]
    #[Cast('immutable_date')]
    public ?Carbon $date;
}

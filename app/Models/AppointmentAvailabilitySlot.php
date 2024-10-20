<?php

namespace App\Models;

use App\Models\Builder\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotBuilder;
use App\Models\Concern\Slot;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Override;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Events\Listener;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

class AppointmentAvailabilitySlot extends Model
{
    use HasFactory, HasUuids, Lift, Slot;

    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $uuid;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public Carbon $start;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public Carbon $end;

    #[Fillable]
    #[Cast('immutable_date')]
    public Carbon $date;

    public int $duration;

    #[Listener]
    public function onUpdated(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        if ($this->duration <= 0) {
            $this->delete();
        }
    }

    #[Override]
    public function newEloquentBuilder($query): AppointmentAvailabilitySlotBuilder
    {
        return new AppointmentAvailabilitySlotBuilder($query);
    }

    public function start(): Attribute
    {
        return Attribute::make(
            set: fn (Carbon $value) => [
                'date' => $value,
                'from' => $value,
                'duration' => $value->diffInMinutes($this->end),
            ],
        );
    }

    public function end(): Attribute
    {
        return Attribute::make(
            set: fn (Carbon $value) => [
                'to' => $value,
                'duration' => $this->start->diffInMinutes($value),
            ],
        );
    }
}

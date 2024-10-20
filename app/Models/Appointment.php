<?php

namespace App\Models;

use App\Models\Concern\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Appointment extends Model
{
    use HasFactory, Lift, SoftDeletes, Uuids;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public Carbon $start;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public Carbon $end;

    #[Fillable]
    public string $title;
}

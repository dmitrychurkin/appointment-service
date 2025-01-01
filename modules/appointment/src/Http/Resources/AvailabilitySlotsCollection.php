<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Resources;

use AppointmentService\Common\Http\Resources\ResourceCollection;
use Illuminate\Http\Request;

final class AvailabilitySlotsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}

<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Resources\Availability;

use AppointmentService\Common\Http\Resources\ResourceCollection;
use Illuminate\Http\Request;

final class AvailabilityCollection extends ResourceCollection
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

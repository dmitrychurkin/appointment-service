<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests\Availability;

use AppointmentService\Appointment\Http\Requests\FormRequest;
use Override;

final class GetAvailabilitySlotsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    #[Override]
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'date' => ['sometimes', 'required', 'date', 'date_format:Y-m-d', 'after:yesterday'],
            'duration' => ['required', 'integer', 'min:1', 'max:1440'],
        ];
    }
}

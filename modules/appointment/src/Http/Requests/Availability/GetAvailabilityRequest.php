<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests\Availability;

use AppointmentService\Appointment\Http\Requests\FormRequest;
use Override;

final class GetAvailabilityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    #[Override]
    public function rules(): array
    {
        $commonDateRules = [
            'sometimes',
            'required',
            'date',
            'date_format:Y-m-d',
        ];

        return [
            ...parent::rules(),
            'duration' => ['required', 'integer', 'min:1', 'max:1440'],
            'date' => [
                ...$commonDateRules,
                'after:yesterday',
            ],
            'start' => [
                ...$commonDateRules,
                'after:yesterday',
            ],
            'end' => [
                ...$commonDateRules,
                'after:start',
                'before_or_equal:'.now()->parse($this->input('start'))->addYear()->toDateString(),
            ],
        ];
    }
}

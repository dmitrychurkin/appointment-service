<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Rules\AppointmentAvailabilitySlotPresence;
use AppointmentService\Common\Http\Requests\FormRequest;
use Override;

final class StoreAppointmentRequest extends FormRequest
{
    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository
    ) {}

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'title' => ['required', 'string'],
            'appointmentAvailabilitySlot' => [new AppointmentAvailabilitySlotPresence],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    #[Override]
    protected function prepareForValidation(): void
    {
        $this->merge([
            'appointmentAvailabilitySlot' => $this->appointmentAvailabilitySlotRepository->getAvailabilitySlot(
                SlotData::from($this->only(['start', 'end']))
            ),
        ]);
    }
}

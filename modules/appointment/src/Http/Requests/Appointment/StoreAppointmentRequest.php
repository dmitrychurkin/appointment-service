<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests\Appointment;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentConfiguration as AppointmentConfigurationRepository;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Http\Requests\FormRequest;
use AppointmentService\Appointment\Rules\AppointmentAvailabilitySlotPresence;
use AppointmentService\Appointment\Rules\LimitNumberOfAppointments;
use AppointmentService\Appointment\Rules\RestrictOutOfConfigurationAvailabilitySlot;
use Override;

final class StoreAppointmentRequest extends FormRequest
{
    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository,
        AppointmentConfigurationRepository $appointmentConfigurationRepository
    ) {
        parent::__construct($appointmentConfigurationRepository);
    }

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
            ...$this->getSlotRules(),
            'title' => ['required', 'string', 'max:255'],
            'appointmentAvailabilitySlot' => [new AppointmentAvailabilitySlotPresence],
            'appointmentConfiguration' => [
                'required',
                new LimitNumberOfAppointments,
                new RestrictOutOfConfigurationAvailabilitySlot,
            ],
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
                SlotData::from($this->validate($this->getSlotRules()))
            ),
        ]);
    }

    private function getSlotRules(): array
    {
        return [
            'start' => ['required', 'date', 'after:now'],
            'end' => ['required', 'date', 'after:start'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentConfiguration as AppointmentConfigurationRepository;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Rules\AppointmentAvailabilitySlotPresence;
use AppointmentService\Appointment\Rules\RestrictOutOfConfigurationAvailabilitySlot;
use AppointmentService\Common\Http\Requests\FormRequest;
use Override;

final class StoreAppointmentRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository,
        private readonly AppointmentConfigurationRepository $appointmentConfigurationRepository
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
            'start' => ['required', 'date', 'after:now'],
            'end' => ['required', 'date', 'after:start'],
            'title' => ['required', 'string', 'max:255'],
            'appointmentAvailabilitySlot' => [new AppointmentAvailabilitySlotPresence],
            'appointmentConfiguration' => ['required', new RestrictOutOfConfigurationAvailabilitySlot],
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
            'appointmentConfiguration' => $this->appointmentConfigurationRepository->getLatestVersion(
                relations: ['configurationAvailabilitySlots']
            ),
        ]);
    }
}

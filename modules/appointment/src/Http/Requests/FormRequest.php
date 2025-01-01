<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Requests;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentConfiguration as AppointmentConfigurationRepository;
use AppointmentService\Common\Http\Requests\FormRequest as CommonFormRequest;
use Override;

abstract class FormRequest extends CommonFormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    public function __construct(
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
            'appointmentConfiguration' => ['required'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    #[Override]
    protected function prepareForValidation(): void
    {
        $this->merge([]);
    }

    /**
     * Merge additional data into the request.
     */
    #[Override]
    public function merge(array $input): static
    {
        parent::merge([
            ...$input,
            'appointmentConfiguration' => $this->appointmentConfigurationRepository->getLatestVersion(
                relations: ['configurationAvailabilitySlots']
            ),
        ]);

        return $this;
    }
}

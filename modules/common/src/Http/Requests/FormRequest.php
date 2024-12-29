<?php

declare(strict_types=1);

namespace AppointmentService\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;

abstract class FormRequest extends HttpFormRequest
{
    /**
     * Get the validated data from the request.
     *
     *
     * @return mixed
     */
    public function from(string $className)
    {
        return $className::from($this->validated());
    }
}

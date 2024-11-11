<?php

namespace Database\Factories;

use Core\Features\Appointment\Enums\AccountSlug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Default Appointy Account',
            'slug' => AccountSlug::DefaultAppointyAccount->value,
        ];
    }
}

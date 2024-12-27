<?php

declare(strict_types=1);

namespace Database\Seeders;

use AppointmentService\Appointment\Enums\AccountSlug;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Appointment\Models\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->for($this->createAccount())
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
    }

    private function createConfigurationAvailabilitySlots()
    {
        return ConfigurationAvailabilitySlot::factory()
            ->count(2)
            ->sequence(
                [
                    'start_time' => '08:00',
                    'end_time' => '13:00',
                ],
                [
                    'start_time' => '14:00',
                    'end_time' => '17:00',
                ]
            );
    }

    private function createAppointmentConfiguration()
    {
        return AppointmentConfiguration::factory()
            ->has($this->createConfigurationAvailabilitySlots(), 'configurationAvailabilitySlots');
    }

    private function createAccount()
    {
        return Account::factory()
            ->has($this->createAppointmentConfiguration(), 'appointmentConfigurations')
            ->create([
                'name' => 'Default Appointy Account',
                'slug' => AccountSlug::DefaultAppointyAccount->value,
            ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Command\CreateAppointment;
use App\Models\Service\AvailabilitySlotManager\AvailabilitySlotManager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class AvailabilityDetectionAlgorithmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    public function test_availability_slot_contains_collection(): void
    {
        $user = User::where('email', 'test@example.com')->firstOrFail();

        $appointmentSlot = CreateAppointment::from([
            'start' => '2022-01-01T00:00:00Z',
            'end' => '2022-01-01T01:00:00Z',
            'account' => $user->account,
        ]);

        $availabilityDetectionAlgorithm = AvailabilitySlotManager::from($appointmentSlot);

        $this->assertInstanceOf(Collection::class, $availabilityDetectionAlgorithm->getAvailabilitySlots());
    }
}

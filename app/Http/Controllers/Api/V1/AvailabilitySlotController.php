<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\{StoreAvailabilitySlotRequest, UpdateAvailabilitySlotRequest};
use App\Models\Appointment\Aggregate\AvailabilitySlot;

class AvailabilitySlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvailabilitySlotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AvailabilitySlot $availabilitySlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AvailabilitySlot $availabilitySlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvailabilitySlotRequest $request, AvailabilitySlot $availabilitySlot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvailabilitySlot $availabilitySlot)
    {
        //
    }
}

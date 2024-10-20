<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentConfigurationRequest;
use App\Http\Requests\UpdateAppointmentConfigurationRequest;
use App\Models\AppointmentConfiguration;

class AppointmentConfigurationController extends Controller
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
    public function store(StoreAppointmentConfigurationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AppointmentConfiguration $appointmentConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppointmentConfiguration $appointmentConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentConfigurationRequest $request, AppointmentConfiguration $appointmentConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentConfiguration $appointmentConfiguration)
    {
        //
    }
}

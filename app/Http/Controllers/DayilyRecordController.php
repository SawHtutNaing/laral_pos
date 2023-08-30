<?php

namespace App\Http\Controllers;

use App\Models\DayilyRecord;
use App\Http\Requests\StoreDayilyRecordRequest;
use App\Http\Requests\UpdateDayilyRecordRequest;

class DayilyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return DayilyRecord::all();
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
    public function store(StoreDayilyRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DayilyRecord $dayilyRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DayilyRecord $dayilyRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayilyRecordRequest $request, DayilyRecord $dayilyRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DayilyRecord $dayilyRecord)
    {
        //
    }
}

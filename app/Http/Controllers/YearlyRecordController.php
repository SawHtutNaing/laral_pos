<?php

namespace App\Http\Controllers;

use App\Models\YearlyRecord;
use App\Http\Requests\StoreYearlyRecordRequest;
use App\Http\Requests\UpdateYearlyRecordRequest;
use Illuminate\Http\Request;

class YearlyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->year;
        return YearlyRecord::where('year', $year)->first();
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
    public function store(StoreYearlyRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(YearlyRecord $yearlyRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(YearlyRecord $yearlyRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYearlyRecordRequest $request, YearlyRecord $yearlyRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YearlyRecord $yearlyRecord)
    {
        //
    }
}

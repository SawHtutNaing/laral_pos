<?php

namespace App\Http\Controllers;

use App\Models\MonthlyRecord;
use App\Http\Requests\StoreMonthlyRecordRequest;
use App\Http\Requests\UpdateMonthlyRecordRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;



class MonthlyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (
            is_null($request->month)
        ) {

            return MonthlyRecord::latest('id')->paginate(12);
        }

        $year = $request->year;


        $month = $request->month;

        return MonthlyRecord::where('month', $month)->where('year', $year)->get();
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
    public function store(StoreMonthlyRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MonthlyRecord $monthlyRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonthlyRecord $monthlyRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMonthlyRecordRequest $request, MonthlyRecord $monthlyRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyRecord $monthlyRecord)
    {
        //
    }
}

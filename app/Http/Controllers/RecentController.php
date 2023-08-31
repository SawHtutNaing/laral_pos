<?php

namespace App\Http\Controllers;

use Carbon\Carbon;


use App\Models\Recent;
use App\Http\Requests\StoreRecentRequest;
use App\Http\Requests\UpdateRecentRequest;
use App\Models\DayilyRecord;
use App\Models\User;
use App\Models\Vouncher;
use App\Models\VouncherRecords;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class RecentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return "hello bya";

        $today = Carbon::today();

        try {
            // my type
            // $records = Vouncher::where('user_id', Auth::id())->whereDate('created_at', $today)
            //     ->with('children_vounchers')
            //     ->get();
            // $records = VouncherRecords::select('product_id', DB::raw('SUM(cost) as total_cost'), DB::raw('SUM(quantity) as total_quantity'))->whereDate('created_at', $today)->groupBy('product_id')->get();
            $records = VouncherRecords::select('product_id', DB::raw('SUM(cost) as total_cost'), DB::raw('SUM(quantity) as total_quantity'))->where('user_id', Auth::id())->whereDate('created_at', $today)->groupBy('product_id')->get();
            return  $records;
        } catch (Exception $e) {
            return $e;
        }

        return  ['records' => $records];
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
    public function store(StoreRecentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recent $recent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recent $recent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecentRequest $request, Recent $recent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recent $recent)
    {
        //
    }
    public function closeSale()
    {


        // $vouncherRecord = new VouncherRecords();
        // try {
        //     return $vouncherRecord->getTodayQuantity();
        // } catch (Exception $e) {
        //     return $e;
        // }
        $vouncherRecord = new VouncherRecords();
        $dy = Carbon::now();

        try {
            $dailyRecord =  DayilyRecord::create([

                'day' => $dy->day,
                'month' => $dy->month,
                'year' => $dy->year,
                'total_sell' => $vouncherRecord->getTodaySell(),
                'cash' => $vouncherRecord->getTodaySell() / 1.05,
                // 'user_id' => Auth::id()

            ]);
        } catch (Exception $e) {
            return $e;
        }

        $user = User::findOrFail(Auth::id());


        // $user->closed_time = Carbon::tomorrow();
        try {
            $user->update();
        } catch (Exception $e) {
            return $e;
        }
        return $dailyRecord;
    }
}

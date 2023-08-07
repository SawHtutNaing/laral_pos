<?php

namespace App\Http\Controllers;

use App\Models\VouncherRecords;
use App\Http\Requests\StoreVouncherRecordsRequest;
use App\Http\Requests\UpdateVouncherRecordsRequest;
use App\Http\Resources\VouncherRecordResource;
use App\Http\Resources\VouncherResource;
use App\Models\Product;
use App\Models\Vouncher;
use Illuminate\Support\Facades\Auth;

class VouncherRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VouncherRecords::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVouncherRecordsRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cost = $product->sales_price * $request->quantity;
        if ($request->quantity >  $product->total_stock) {
            return response()->json(['alert' => 'not enough stock']);
        }
        $product->total_stock -= $request->quantity;
        $product->update();
        $VouncherRecord =   VouncherRecords::create([
            'vouncher_id' => $request->vouncher_id,
            'product_id' => $request->product_id,

            'quantity' => $request->quantity,
            'cost' => $cost
        ]);
        $vouncher =  $VouncherRecord->Vouncher;
        $vouncher->total +=  $VouncherRecord->cost;
        $vouncher->net_total = $vouncher->total  + ($vouncher->total * ($vouncher->tax / 100));
        $vouncher->update();
        return new  VouncherResource($vouncher);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new VouncherRecordResource(VouncherRecords::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVouncherRecordsRequest $request, $id)
    {
        $VouncherRecord = VouncherRecords::findOrFail($id);



        if (is_null($VouncherRecord)) {
            return response()->json([
                'message' => 'VouncherRecord not found'
            ], 404);
        }

        if ($request->has('vouncher_id')) {
            $VouncherRecord->vouncher_id  = $request->vouncher_id;
        }
        if ($request->has('product_id')) {
            $VouncherRecord->product_id  = $request->product_id;
        }
        if ($request->has('quantity')) {
            $VouncherRecord->quantity  = $request->quantity;
        }

        if ($request->has('cost')) {
            $VouncherRecord->cost  = $request->cost;
        }



        $VouncherRecord->update();


        return new VouncherResource($VouncherRecord);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        VouncherRecords::findOrFail($id)->delete();
        return response()->json(['msg' => 'vouncherRecord is deleted successfuly ']);
    }
}

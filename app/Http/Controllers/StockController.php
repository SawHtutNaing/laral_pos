<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Resources\Stock as ResourcesStock;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
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
        return new StockCollection(Stock::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {
        logger("i am stock store");
        // $stock = Stock::create([
        //     'user_id' => Auth::id(),
        //     'product_id' => $request->product_id,
        //     'quantity' => $request->quantity,
        //     'more' => $request->more
        // ]);
        // return new StockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new StockResource(Stock::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, $id)
    {
        $stock = Stock::findOrFail($id);



        if (is_null($stock)) {
            return response()->json([
                'message' => 'brand not found'
            ], 404);
        }

        if ($request->has('product_id')) {
            $stock->product_id  = $request->product_id;
        }
        if ($request->has('quantity')) {
            $stock->quantity  = $request->quantity;
        }
        if ($request->has('more')) {
            $stock->more  = $request->more;
        }





        $stock->update();


        return new StockResource($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Stock::findOrFail($id)->delete();
        return response()->json(['msg' => 'stock is deleted successfuly ']);
    }
}

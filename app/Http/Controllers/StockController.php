<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Resources\Stock as ResourcesStock;
use App\Http\Resources\StockCollection;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
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
        Stock::create([
            'usre_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'more' => $request->more
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}

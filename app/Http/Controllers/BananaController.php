<?php

namespace App\Http\Controllers;

use App\Models\Banana;
use App\Http\Requests\StoreBananaRequest;
use App\Http\Requests\UpdateBananaRequest;

class BananaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBananaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Banana $banana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBananaRequest $request, Banana $banana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banana $banana)
    {
        //
    }
}

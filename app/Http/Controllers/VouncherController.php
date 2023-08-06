<?php

namespace App\Http\Controllers;

use App\Models\Vouncher;
use App\Http\Requests\StoreVouncherRequest;
use App\Http\Requests\UpdateVouncherRequest;
use App\Http\Resources\VouncherResource;
use Exception;
use Illuminate\Support\Facades\Auth;

class VouncherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vouncher::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVouncherRequest $request)
    {

        try {
            $vouncher = Vouncher::create([
                'customer' => $request->name,
                'vouncher_number' => fake()->randomNumber(),
                'tax' => $request->tax,
                'total' => 0,
                'net_total' => 0,
                'user_id' => Auth::id()

            ]);
        } catch (Exception $e) {
            return $e;
        }

        return new VouncherResource($vouncher);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new VouncherResource(Vouncher::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVouncherRequest $request, Vouncher $vouncher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Vouncher::findOrFail($id)->delete();
        return response()->json(['msg' => 'vouncher  is deleted successfuly ']);
    }
}

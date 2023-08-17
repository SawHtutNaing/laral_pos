<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StorebrandRequest;
use App\Http\Requests\UpdatebrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only(['destroy', 'update', 'store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BrandCollection(Brand::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        // return "min gla r";
        $ok  = [
            "name" => $request->name,
            "company" => $request->company,
            "information" => $request->information,
            "user_id" => Auth::id()
            // "photo" => $request->photos
        ];
        // return $ok;
        // $brand = brand::create($ok);
        // return new BrandResource($brand);
        $brand = Brand::create([
            "name" => $request->name,
            "company" => $request->company,
            "information" => $request->information,
            "user_id" => Auth::id()
        ]);
        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        return new BrandResource(brand::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebrandRequest $request, $id)
    {

        $brand = Brand::findOrFail($id);




        if (is_null($brand)) {
            return response()->json([
                'message' => 'brand not found'
            ], 404);
        }

        if ($request->has('name')) {
            $brand->name  = $request->name;
        }
        if ($request->has('company')) {
            $brand->company  = $request->company;
        }
        if ($request->has('information')) {
            $brand->information  = $request->information;
        }
        if ($request->has('photo')) {
            $brand->photo  = $request->photo;
        }

        $brand->update();

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // return Auth::user()->role;
        Brand::findOrFail($id)->delete();
        return response()->json(['msg' => 'brand  is deleted successfuly ']);
    }
}

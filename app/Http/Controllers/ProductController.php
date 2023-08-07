<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\ProductResource;
use App\Models\Stock;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
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
        return new BrandCollection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $check = Product::where('name', $request->name)->where("brand_id", $request->brand_id)->first();
        if ($check) {
            return  response()->json(['msg' => "this product is already in store"]);
            // return $check;
        }
        $product =  Product::create(
            [
                "name" => $request->name,
                "brand_id" => $request->brand_id,
                "actually_price" => $request->actually_price,
                "sales_price" => $request->sales_price,
                "total_stock" => $request->total_stock,
                "unit" => $request->unit,
                "more_information" => $request->more_information,
                "user_id" => Auth::id(),
                "photo" => "dsdsd"

            ]
        );



        $stock =  Stock::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $product->total_stock,
            'more' => $product->more_information
        ]);


        // redirect()->route('stock.store', ['product_id' => $product->id, 'quantity' => $product->total_stock, 'more' => $product->more_information]);
        // route('stock.store');



        $data = [
            'model1' => $product,
            'model2' => $stock,
        ];
        // return $data;

        return new ProductResource($data);
        // return response()->json(['msg' => 'stock dispaly log successfuly ']);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);



        if (is_null($product)) {
            return response()->json([
                'message' => 'brand not found'
            ], 404);
        }

        if ($request->has('name')) {
            $product->name  = $request->name;
        }
        if ($request->has('brand_id')) {
            $product->brand_id  = $request->brand_id;
        }
        if ($request->has('actually_price')) {
            $product->actually_price  = $request->actually_price;
        }

        if ($request->has('total_stock')) {
            $product->total_stock  = $request->total_stock;
        }
        if ($request->has('unit')) {
            $product->unit  = $request->unit;
        }
        if ($request->has('more_information')) {
            $product->more_information  = $request->more_information;
        }


        $product->update();
        if ($request->mood == 1) {

            Stock::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $product->total_stock,
                'more' => $product->more_information
            ]);
        }

        return new ProductResource($product);
    }


    public function SaleProduct(Request $request)
    {
        // return "kkkk";

        $product = Product::findOrFail($request->product_id);
        $product->total_stock -= $request->quantity;
        $product->update();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['msg' => 'product is deleted successfuly ']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

use App\Http\Resources\VouncherResource;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Vouncher;
use App\Models\VouncherRecords;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('isAdmin')->only(['destroy', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // return new ProductCollection(Product::paginate(5)->withQueryString());
        return  Product::paginate(8)->withQueryString();
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)

    {
        // return $request;

        $check = Product::where('name', $request->name)->where("brand_id", $request->brand_id)->first();
        if ($check) {
            return  response()->json(['msg' => "this product is already in store"]);
            // return $check;
        }

        // $savedProductPhoto = null;
        // $fileExt = null;
        // $fileName = null;
        // $fileSize = null;


        $photo = null;
        if ($request->hasFile('photo')) {
            // dd("thisis");
            $fileExt =  $request->file('photo')->extension();
            $fileName = $request->file('photo')->getClientOriginalName();
            $savedProductPhoto =  asset(Storage::url($request->file('photo')->store("public/media")));
            $fileSize =    $request->file('photo')->getSize();

            $photo  =  Photo::create([
                'url' => $savedProductPhoto,
                'extension' => $fileExt,
                'name' => $fileName,
                'file_size' =>  $fileSize,

                'user_id' => Auth::id()
            ]);
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
                "photo" => $photo->url,


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
        // return new ProductResource(Product::findOrFail($id));
        return Product::findOrFail($id);
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

        if ($request->mood == 1) {
            $add = $request->total_stock -  $product->total_stock;

            Stock::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $add,
                'more' => $request->more_information
            ]);
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

        // return new ProductResource($product);
        return $product;
    }


    public function SaleProduct(Request $request)
    {
        if (Auth::user()->closed_time > Carbon::today()) {
            return 'sales is opened tomorrow';
        }


        $jsonData = json_decode($request->getContent(), true);
        $info = $jsonData['info'];
        $data = $jsonData['data'];

        $vouncher = Vouncher::create([
            'customer' => $info['cus_name'],
            "vouncher_number" => Str::uuid()->toString(),
            'total' => 0,
            'tax' =>  $info['tax'],
            'net_total' => 0,
            'user_id' => Auth::id()
        ]);

        $record_for_items = [];
        foreach ($data as $each) {
            $product = Product::findOrFail($each['product_id']);
            if ($each['quantity'] >  $product->total_stock) {
                return response()->json(['alert' => 'not enough stock']);
            }

            $product->total_stock -= $each['quantity'];
            $product->update();

            // $vouncher_record = VouncherRecords::create([
            //     'vouncher_id' => $vouncher->id,
            //     "product_id" => $each['product_id'],
            //     "cost" => $product->sales_price,

            //     "quantity" => $each['quantity']
            // ]);
            $vouncher_record = [
                'vouncher_id' => $vouncher->id,
                "product_id" => $each['product_id'],
                "cost" => $product->sales_price,
                "user_id" => Auth::id(),
                "quantity" => $each['quantity'],
                "created_at" => now(),
                'updated_at' => now()
            ];
            // $vouncher->total +=  $vouncher_record->cost;
            $vouncher->total +=  $vouncher_record['cost'];
            // $vouncher->net_total += $vouncher_record->cost  + ($vouncher_record->cost  * ($vouncher->tax / 100));
            $vouncher->net_total += $vouncher_record['cost']  + ($vouncher_record['cost']  * ($vouncher->tax / 100));
            array_push(
                $record_for_items,
                $vouncher_record
            );
            $vouncher->update();
        };
        VouncherRecords::insert($record_for_items);

        return new VouncherResource($vouncher);
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

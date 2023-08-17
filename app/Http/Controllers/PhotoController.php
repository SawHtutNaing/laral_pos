<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Photo::paginate(1)->withQueryString());
        return Photo::paginate(7)->withQueryString();
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
    public function store(StorePhotoRequest $request)

    {



        // if ($files = $request->hasFile('photos')) {
        //     foreach ($files as $photo) {

        //         $fileExt =  $request->file('photo')->extension();
        //         $fileSize =  $request->file('photo')->getSize();
        //         $fileName = $request->file('photo')->getClientOriginalName();
        //         $savedPhoto = $request->file("photo")->store("public/media");
        //         $photo =   Photo::create([
        //             'url' => $savedPhoto,
        //             'extension' => $fileExt,
        //             'name' => $fileName,
        //             'file_size' => $fileSize,
        //             'user_id' => Auth::id()
        //         ]);
        //     }
        // } else {
        //     return "need image file to store ";
        // }


        // $input = $request->all();
        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {

                $arr = [
                    'extension' =>  $file->extension(),
                    'file_size' =>  $file->getSize(),
                    'name' => $file->getClientOriginalName(),
                    'url' => $file->store("public/media"),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'user_id' => Auth::id()

                ];

                $images[] = $arr;
                // Photo::insert($arr);
            }
        }



        try {
            Photo::insert($images);
        } catch (Exception $e) {
            return $e;
        }


        return $images;
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {




        Photo::findOrFail($id)->delete();
    }
}

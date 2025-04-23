<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Product_variant;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::all();
        return view('admin.modules.image.index_image', [
            'images' => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variants = Product_variant::all();
//        dd($variants);
        return view('admin.modules.image.add_image',[
            'variants' =>$variants,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $imageName = $request->file('url')->getClientOriginalName();

//        dd($imageName);//
        Image::create([
            'product_variant_id'=>$request->product_id,
            'url'=> $request->image,

        ]);
        return Redirect::route('images.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}

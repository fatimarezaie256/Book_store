<?php

namespace App\Http\Controllers;

use App\Models\Uploadpicture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule as CssRule;

class ProductController extends Controller
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
    public function store(Request $request)
    {
        //
        try{
      $validated =  $request->validate([
            "name"=>["string","required","min:3",
            Rule::unique("uploadpictures","name")
            ],
            "price"=>"required|numeric",
            "image"=>"required|image|mimes:jpg,png,jpeg,gif"
        ]);
        $imagePath = "";
        if($request->hasFile('image')){
            $imagePath = $request->file("image")->store("product","public");
        }
       $product = Uploadpicture::create(
            [
                "name"=>$validated['name'],
                "price"=>$validated['price'],
                "img_url"=>$imagePath
            ]
        );
        return response()->json([
                "data"=>$product,
        ]);
        }
        catch(Exception $err){
            return response()->json([
                "messege"=>$err->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

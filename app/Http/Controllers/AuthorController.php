<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorInsertRequest;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $author = Author::all();
        return response()->json([
            "author"=>$author
        ]);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorInsertRequest $request)
    {
        //
        $author = Author::create([
            "name"=>$request->name,
            "bio"=>$request->bio,
            "nationality"=>$request->nationality

        ]);
        return response()->json([
            "createdAuthor"=>$author
        ]);
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
    public function update(AuthorInsertRequest $request, string $id)
    {
        //
       $author = Author::findOrFail($id);
       $author->update($request->validated());
       return response()->json([
        "author"=>$author,
       ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
   
    }
}

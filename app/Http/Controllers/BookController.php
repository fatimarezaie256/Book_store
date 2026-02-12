<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
// use app\Http\Requests\BookInsertRequest;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      $book = Book::all();
      return response()->json([
        "book"=>$book,
      ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $book = Book::create([
            "title"=>$request->title,
            "isbn"=>$request->isbn,
            "description"=>$request->description,
            "published_at"=>$request->published_at,
            "total_copies"=>$request->total_copies,
            "available_copies"=>$request->available_copies,
            "image"=>$request->cover_image,
            "status"=>$request->status,
            "price"=>$request->price,
            "author_id"=>$request->author_id,
            "genre"=>$request->genre,

         ]);
         return response()->json([
            "Books"=>$book,
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

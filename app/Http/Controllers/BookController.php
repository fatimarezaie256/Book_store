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
    public function index(Request $request)
    {
        //
      $book = Book::all();
      $query = Book::with('author');
        if($request->has('search')){
            $search = $request->search;
            $query->where(function($q) use ($search){
            $q->where('title','LIKE',"%{$search}%")
            ->orWhere('isbn','LIKE',"%{$search}%")
            ->orwhereHas('author',function ($authorquery) use($search) {
             $authorquery->where('name','LIKE',"%{$search}%");
            });
            });
        }
        $book = $query->paginate(10);
      return response()->json([
        "book"=>$book,
      ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create([
    "title"=>$request->title,
    "isbn"=>$request->isbn,
    "description"=>$request->description,
    "published_at"=>$request->published_at,
    "total_copies"=>$request->total_copies,
    "available_copies"=>$request->available_copies,
    "cover_image"=>$request->image,   
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
       $book = Book::findorfail($id);
       $book->update([
        "title"=>$request->title,
        "isbn"=>$request->isbn,
        "description"=>$request->description,
        "published_at"=>$request->published_at,
        "total_copies"=>$request->total_copies,
        "available_copies"=>$request->available_copies,
        "cover_image"=>$request->image,
        "status"=>$request->status,
        "price"=>$request->author_id,
        "genre"=>$request->genre,
       ]);
       return response()->json([
        "updatedBooks"=>$book,
       ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
            $book = Book::findOrFail($id);
       $book->delete();
       return response()->json([
        "messege"=>"the considered book deleted successfully!"
       ]);
    }
}

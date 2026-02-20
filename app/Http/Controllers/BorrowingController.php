<?php

namespace App\Http\Controllers;

use App\Models\borrowing;
use App\Models\member;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $borrow = borrowing::all();
       return response()->json([
        "All borrowings"=>$borrow,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        borrowing::create([
            "book_id"=>$request->book_id,
        ]);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $borrow = borrowing::findOrFail($id);
       
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

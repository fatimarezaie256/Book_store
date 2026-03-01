<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequest;
use App\Http\Resources\bookResource;
use App\Http\Resources\BorrowingResource;
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
          $borrowings = Borrowing::with('book','member')->paginate(10);

    return BorrowingResource::collection($borrowings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $borrow = borrowing::create([
            "book_id"=>$request->book_id,
            "member_id"=>$request->member_id,
            "borrowed_date"=>$request->borrowed_date,
            "due_date"=>$request->due_date,
            "status"=>$request->status,
        ]);
        return response()->json([
            "Inserted Borrowing Book"=> $borrow,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(borrowing $borrow)
    {
        //
       $borrow->load(['book','member']);
       return new bookResource($borrow);
       
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

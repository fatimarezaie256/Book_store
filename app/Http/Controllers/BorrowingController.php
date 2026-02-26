<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequest;
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
      $borrowings = borrowing::with('book','member');
      $borrowings->paginate(10);
      return BorrowingResource::collection($borrowings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowingRequest $request)
    {
        //
        $borrow = borrowing::create($request->validated());
        return response()->json([
            "data"=>$borrow,
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

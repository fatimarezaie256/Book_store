<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequest;
use App\Http\Requests\BorrowingUpdateRequest;
use App\Http\Resources\bookResource;
use App\Http\Resources\BorrowingResource;
use App\Models\borrowing;
use App\Models\member;
use Exception;
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
    public function store(BorrowingRequest $request)
    {
        //
       $borrow = borrowing::findOrFail($request->book_id);

        if($borrow->available_copies >0){
        $borrowing = borrowing::create($request->validated);
        };
        $borrowing->book->borrow();
        $borrowing->load(['book','member']);
        return new BorrowingResource($borrowing);
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
    public function update(BorrowingUpdateRequest $request, string $id)
    {
        //
        try{
           $borrowing = borrowing::findOrfail($id);
           $borrowing->update($request->validated());
           return new BorrowingResource($borrowing);

        }
        catch(Exception $err){
          return response()->json([
            "messege"=>$err->getMessage(),
          ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $member = borrowing::findOrFail($id);
        $member->load(['book','activeBorrowing']);
        if($member->activeBorrowing()->count()>0){
             return response()->json(
                ["messege"=>"You can not delete". $member->name. "because he/she have borrowed some books".$member->activeBorrowing()->count() . "books"],
             );

        }
        else{
            $member->delete();
            return response()->json([
                "meesege"=>"member has been deleted successfully",
            ]);
        }
          
    }
}

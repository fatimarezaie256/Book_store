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

use function Symfony\Component\Clock\now;

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
    public function returnBook(borrowing $borrow){
        if($borrow->status !=='borrowed'){
            return response()->json([
                ['messege'=>'the book has already been taken'],
            ]);
            $borrow->update([
                "returned_date"=>now(),
                "status"=>"returned"
            ]);
            $borrow->book->returnBook();
            $borrow->load('book','member');
            return new BorrowingResource($borrow);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
     public function overdue(){
            $overdueBorrowings = borrowing::with(['book','member'])->
            where('status','borrowed')->
            where('due_date','<',now())->update([
                'status'=>'over_due'
            ]);
            return BorrowingResource::collection($overdueBorrowings);

     }
}

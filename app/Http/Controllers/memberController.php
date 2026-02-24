<?php

namespace App\Http\Controllers;

use App\Http\Resources\memberRecourse;
use App\Models\member;
use Exception;
use Illuminate\Http\Request;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         $query = member::with('borrowing');
                if($request->has('search')){
                    $search = $request->search;
                    $query->where(function($q) use ($search){
                    $q->where('name','LIKE',"%{$search}%");
                    });
                      $member = $query->paginate(10);
                }

        $member = $query->paginate(10);
             return memberRecourse::collection($member);
    }
                
                
                /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
       $member = member::create([
       "name"=>$request->name,   
       "email"=>$request->email,   
       "address"=>$request->address,   
       "membership_date"=>$request->membership_date,   
       "whatsupNumber"=>$request->whatsupNumber,   
       "status"=>$request->status,  
       ]);
       return response()->json([
        "InsertedMember"=>$member,
       ]);}catch(Exception $error){
        return response()->json([
          "error"=>"sorry something went wrong.please try again!"
        ]);
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
       $member = member::findOrFail($id);
       return response()->json([
        "Single Memeber"=>$member,
       ]);}catch(Exception $error){
        return response()->json([
            "error"=>"the id " . $id . " was not found.please try again!"
        ]);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try{
        $member = member::findOrFail($id);
        $member->update([
        "name"=>$request->name,
        "email"=>$request->email,
        "address"=>$request->address,
        "membership_date"=>$request->membership_date,
        "whatsupNumber"=>$request->whatsupNumber,
        "status"=>$request->status,
       ]);
       return response()->json([
        "Updated Member"=>$member,
       ]);}
       catch(Exception $error){
           return response()->json([
            "error"=> "the id " . $id ."  was not found.please try again!"
,           ],
           403
);
       }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
     $member = member::findOrFail($id);
     $member->delete();
     return response()->json([
        "messege"=>$member->name. " deleted successfully from list of members",
     ]);}catch(Exception $error){
        return response()->json([
            "error"=>"the selected id was not found.please try again!"
        ]);
     }
    }
}

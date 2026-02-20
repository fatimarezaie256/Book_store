<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      $member = member::all();
     return response()->json([
        "All members"=>$member,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
       ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $member = member::findOrFail($id);
       return response()->json([
        "Single Memeber"=>$member,
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
       ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
     $member = member::findOrFail($id);
     $member->delete();
     return response()->json([
        "messege"=>$member->name. " deleted successfully from list of members",
     ]);
    }
}

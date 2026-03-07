<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
       $validated = $request->validate( 
        [
            "name"=>"required|string|min:3|max:30",
            "email"=>"required|unique:users,email|string",
            "password"=>"required|min:6|confirmed"
        ]
        );
        $user = User::create([
            "name"=>$validated["name"],
            "email"=>$validated["email"],
            "password"=>Hash::make( $validated["password"]),
         ]);

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "success"=>true,
            "user"=>new UserResource($user),
            "token"=>$token,
        ]);
     }
    


    public function Login(){
         
    }
}
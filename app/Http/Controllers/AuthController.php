<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
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
    


    public function login(Request $request){
         $validated = $request->validate([
            "email"=>"required|string",
            "password"=>"required|string|min:6",
          ]);

         $user = User::where('email',$validated["email"])->first();
         if($user || !Hash::check($validated["password"],$user->password)){
            return response()->json([
               "success"=>"false",
                "messege"=>"email or password is incorrect!"
            ]);
         }
        $token = $user->createToken("auth_token")->plainText;
        return response()->json([
            "success"=>"true",
            "user"=>new UserResource($user),
            "token"=>$token,
        ]);
    }
            
      
    
    public function logout(Request $request){
           $request->user()->currentAccessToken()->delete();
           return response()->json([
            "messege"=>"You are logged out!"
           ]);
    }

    }
    
  
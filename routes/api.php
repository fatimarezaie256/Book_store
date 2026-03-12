<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\AuthorController;
use App\Http\controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\memberController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 


Route::apiResource('member',memberController::class);

Route::apiResource('borrowing',BorrowingController::class)->only('index','store','show');

Route::post('borrow/{borrowing}/return',[BorrowingController::class,'returnBook']);

Route::get("borrow/overdue",[BorrowingController::class,'overdue']);
// registerd route
Route::post('register',[AuthController::class,'register']);
// login route
Route::post('login',[AuthController::class,'login']);
// middleware
Route::middleware('auth:sanctum')->group(function (){
  Route::apiResource('author',AuthorController::class);
  Route::apiResource('book',BookController::class);
  Route::post('logout',[AuthController::class,'logout']);
});
Route::prefix()->group(function (){
  
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\AuthorController;
use App\Http\controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\memberController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 
Route::apiResource('author',AuthorController::class);
Route::apiResource('book',BookController::class);
Route::apiResource('member',memberController::class);
Route::apiResource('borrowing',BorrowingController::class)->only('index','store','show');
Route::post('borrow/{borrow_id}/return',[BorrowingController::class,'returnBook']);
Route::get("borrow/overdue",[BorrowingController::class,'overdue']);

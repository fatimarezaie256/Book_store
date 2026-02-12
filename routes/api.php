<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\AuthorController;
use App\Http\controllers\BookController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 
Route::apiResource('author',AuthorController::class);
Route::apiResource('book',BookController::class);
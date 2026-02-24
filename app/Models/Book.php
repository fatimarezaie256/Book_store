<?php

namespace App\Models;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Modls\Author;
use app\Http\Modls\Borrowing;
use App\Models\borrowing as ModelsBorrowing;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable =[
        "title",
        "isbn",
        "description",
        "published_at",
        "total_copies",
        "available_copies",
        "genre",
        "price",
        "cover_image",
        "status",
        "author_id",
    ];
    public function author(){
       return $this->belongsTo(AuthorController::class,'author_id');
    }
    public function borrowing(){
        return $this->hasMany(BorrowingController::class);
    }
    public function isAvailable(){
        return $this->available_copies>0;
    }
    public function borrow(){
        if($this->availabale_copies<0){
            $this->decreament('available_copies');
        }
    }
    public function returnBack(){
        if($this->availabale_copies<$this->total_copies){
            $this->increament('available_copies');
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function index(Book $book)
    {
        return response()->json($book->all());
    }
}

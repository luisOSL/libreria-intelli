<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function index() {
        // Returns books with their author details
        return response()->json(Book::with('author')->get(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = Book::create($data);
        return response()->json($book->load('author'), 201);
    }

    public function destroy($id) {
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully'], 204);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function index()
    {
        // Returns books with their author details
        return response()->json(Book::with('author')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = Book::create($data);
        return response()->json($book->load('author'), 201);
    }

     public function show($id)
    {
        return Book::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id'
        ]);

        // Eloquent update fires the 'updated' event
        // If you changed the author_id, you might need manual count adjustment 
        // depending on how you structured your boot() method earlier.
        $book->update($data);

        return response()->json($book->load('author'), 200);
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully'], 204);
    }
}

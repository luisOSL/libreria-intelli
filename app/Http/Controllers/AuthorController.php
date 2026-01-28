<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    public function store(Request $request)
    {
        $author = Author::create($request->validate(['name' => 'required|string']));
        return response()->json($author, 201);
    }

    public function show($id)
    {
        return Author::with('books')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $author->update([
            'name' => $request->name
        ]);
        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return response()->json(['message' => 'Author deleted'], 200);
    }
}

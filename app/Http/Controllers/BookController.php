<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function create() {
        return view('book.create');
    }

    function store(Request $request) {
        $request->validate([
            'title'     =>  'required',
            'writer'    =>  'required',
            'cover'     =>  'required|image|max:2048',
            'synopsis'  =>  'required',
            'category'  =>  'required',
        ]);

        $cover = $request->file('cover');
        $new_name = rand() . '.' . $cover->getClientOriginalExtension();
        $cover->move(public_path('images'), $new_name);
        
        $book = new Book;
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->cover = $new_name;
        $book->synopsis = $request->synopsis;
        $book->category = $request->category;
        $book->save();

        return back();
    }

    function show($id) {
        $book = Book::find($id);

        return view('book.show')
                ->with('book', $book);
    }
}

<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create() {
        return view('book.create');
    }

    public function store(Request $request) {
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
        $book->title    = $request->title;
        $book->writer   = $request->writer;
        $book->cover    = $new_name;
        $book->synopsis = $request->synopsis;
        $book->category = $request->category;
        $book->save();

        return back();
    }

    public function show($id) {
        $book = Book::find($id);

        return view('book.show')
                ->with('book', $book);
    }

    public function edit($id) {
        $book = Book::find($id);

        return view('book.edit')
                ->with('book', $book);
    }

    public function update(Request $request) {
        $request->validate([
            'title'     =>  'required',
            'writer'    =>  'required',
            'cover'     =>  'image|max:2048',
            'synopsis'  =>  'required',
            'category'  =>  'required',
        ]);

        $book = Book::find($request->id);
        
        if (isset($request->cover)) {
            $cover = $request->file('cover');
            $new_name = rand() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('images'), $new_name);
            
            $book->cover    = $new_name;
        }

        $book->title    = $request->title;
        $book->writer   = $request->writer;
        $book->synopsis = $request->synopsis;
        $book->category = $request->category;
        $book->save();

        return redirect('/book/'.$request->id);
    }

    public function destroy($id) {
        $book = Book::find($id);
        $book->delete();

        return redirect('/');
    }
}

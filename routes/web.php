<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Book;

Route::get('/', function () {
    $books = Book::all();
    
    return view('homepage')
            ->with('books', $books);
});

Route::get('/new-book', 'bookController@create');
Route::post('/new-book', 'bookController@store')->name('book.store');
Route::get('/book/{id}', 'bookController@show');
Route::get('/book/{id}/edit', 'bookController@edit');
Route::put('/book/{id}', 'bookController@update')->name('book.update');
Route::delete('/book/{id}', 'bookController@destroy');

<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function store(Request $request, $id) {
        $review = new Review;
        $review->name = $request->name;
        $review->review = $request->review;
        $review->book_id = $id;
        $review->save();

        return redirect('/book/'.$id);
    }
}

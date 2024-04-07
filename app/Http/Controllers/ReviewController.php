<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        $review = Review::factory()->create();

        return response()->json($review);
    }

    public function store(Request $request)
    {
        $review = Review::factory()->make();

        return response()->json($review);
    }
}

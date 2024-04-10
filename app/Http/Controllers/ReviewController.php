<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
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
        $data = $request->validate([
            'film_id'=>['required', 'int'],
            'user_id'=>['required', 'int'],
            'stars'=>['required'],
            'title'=>['nullable', 'string'],
            'text'=>['nullable', 'string'],
        ]);

        $review = Review::create($data);


        return back();
    }

    public function destroy(string $id)
    {
        $review = Review::destroy($id);

        return back();
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'stars'=>['required', 'int'],
            'title'=>['nullable', 'string'],
            'text'=>['nullable', 'string'],
        ]);

        $review = Review::find($id);
        $review->stars = $data['stars'];
        $review->title = $data['title'];
        $review->text = $data['text'];

        $review->save();

        return response()->json($review);
    }

    public function getFilmReviews(string $filmID)
    {
        $reviews = Review::where('film_id', $filmID)->orderBy('created_at', 'desc')->get();
        return $reviews;
    }
}
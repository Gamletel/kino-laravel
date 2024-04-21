<?php

namespace App\Services;

use App\Http\Requests\Reviews\UpdateReviewRequest;
use App\Models\Review;

class ReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function updateReview(array $data ,int $id):Review
    {
        $review = Review::findOrFail($id);
        $review->stars = $data['stars'];
        $review->title = $data['title'];
        $review->text = $data['text'];

        $review->save();

        return $review;
    }

    public function getReviewByFilmID(int $id):Review
    {
        return Review::where('film_id', $id)->orderBy('created_at', 'desc')->get();
    }
}

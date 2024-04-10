<?php

namespace App\Http\Controllers;

use App\Models\UserReviewReaction;
use Illuminate\Http\Request;

class UserReviewReactionController extends Controller
{
    public function setLike(string $user_id, string $review_id)
    {
        $userReviewReaction = UserReviewReaction::where('user_id', $user_id)->where('review_id', $review_id)->first();
        if ($userReviewReaction) {
            $userReviewReaction->like = !$userReviewReaction->like;
            $userReviewReaction->dislike = false;
            $userReviewReaction->save();

        } else {
            $userReviewReaction = UserReviewReaction::create([
                'user_id'=>$user_id,
                'review_id'=>$review_id,
                'like'=>true,
                'dislike'=>false,
            ]);
        }

    }

    public function setDislike(string $user_id, string $review_id)
    {
        $userReviewReaction = UserReviewReaction::where('user_id', $user_id)->where('review_id', $review_id)->first();
        if ($userReviewReaction) {
            $userReviewReaction->like = false;
            $userReviewReaction->dislike = !$userReviewReaction->dislike;
            $userReviewReaction->save();

        } else {
            $userReviewReaction = UserReviewReaction::create([
                'user_id'=>$user_id,
                'review_id'=>$review_id,
                'like'=>false,
                'dislike'=>true,
            ]);
        }

    }

    public function getLikes(string $id)
    {
        $likes = UserReviewReaction::where('review_id', $id)->where('like', true)->count();

        return $likes;
    }

    public function getDislikes(string $id)
    {
        $dislikes = UserReviewReaction::where('review_id', $id)->where('dislike', true)->count();

        return $dislikes;
    }
}

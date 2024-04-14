<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;
use App\Models\User;
use App\Models\UserReviewReaction;
use App\Notifications\LikeReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
                'user_id' => $user_id,
                'review_id' => $review_id,
                'like' => true,
                'dislike' => false,
            ]);
        }

        if($userReviewReaction->like === true){
            $review = Review::find($review_id);
            $user = User::find($review->user_id);
            $film_name = Film::find($review->film_id)->name;
            $data = [
                'film_name'=>$film_name
            ];

            Notification::send($user, new LikeReviewNotification($data));
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
                'user_id' => $user_id,
                'review_id' => $review_id,
                'like' => false,
                'dislike' => true,
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

    public function checkUserLike(string $user_id, string $review_id): bool
    {
        return UserReviewReaction::where('user_id', $user_id)->where('review_id', $review_id)->where('like', true)->exists();
    }

    public function checkUserDislike(string $user_id, string $review_id): bool
    {
        return UserReviewReaction::where('user_id', $user_id)->where('review_id', $review_id)->where('dislike', true)->exists();
    }
}

<?php

namespace App\Listeners;

use App\Events\ReviewLiked;
use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReviewLikedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Review $review): void
    {
        $review->user_id->notify(new CommentLikedNotification($review));
    }
}

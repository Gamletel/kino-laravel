<?php

namespace App\Listeners;

use App\Events\ReviewLiked;
use App\Models\Review;
use App\Notifications\LikeReviewNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;

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
    public function handle(ReviewLiked $event)
    {
        Notification::send($event->user, new LikeReviewNotification($event->data));
    }


}

<?php

use App\Models\Review;
use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

Broadcast::channel('review-liked-channel', function (Review $review){
    return auth()->check();
});

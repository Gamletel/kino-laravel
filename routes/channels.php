<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\UserChannel;

//Broadcast::channel('test', UserChannel::class);
//Broadcast::channel('test', \App\Broadcasting\TestChannel::class);
Broadcast::channel('test', function ($user) {
    // Проверяем, что пользователь авторизован
    return $user !== null;
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReviewReactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*AUTH*/
Route::get('/create-user', [AuthController::class, 'createUser'])
    ->name('user.create');
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])
    ->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');
Route::get('/register', [UserController::class, 'register'])
    ->name('user.register');
Route::post('/register', [UserController::class, 'store'])
    ->name('user.store');

/*USER PROFILE*/
Route::get('/user/{$id}/dashboard', [UserController::class, 'dashboard'])
    ->name('user.dashboard');
Route::get('/user/{id}/data', [UserController::class, 'showData'])
    ->name('user.show.data');
Route::get('/user/{id}/reviews', [UserController::class, 'showReviews'])
    ->name('user.show.reviews');
Route::post('user/update/name', [UserController::class, 'updateName'])
    ->name('user.update.name');
Route::post('user/update/email', [UserController::class, 'updateEmail'])
    ->name('user.update.email');
Route::post('user/update/avatar', [UserController::class, 'updateAvatar'])
    ->name('user.update.avatar');
Route::post('user/update/password', [UserController::class, 'updatePassword'])
    ->name('user.update.password');
Route::get('/user/{id}', [UserController::class, 'show'])
    ->name('user.show');

/*VERIFY EMAIL*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/user/dashboard');
})->name('verification.verify');

Route::post('/email/verification-notification', function () {
    auth()->user()->sendEmailVerificationNotification();

    return back();
})->middleware(['auth', 'throttle:6,1'])->middleware('auth')->name('verification.send');

/*FILMS*/
Route::get('/films', [FilmController::class, 'index'])
    ->name('films');
Route::get('/film/create', [FilmController::class, 'create'])
    ->name('film.create');
Route::post('/film/create', [FilmController::class, 'store'])
    ->middleware(['admin'])->name('film.store');
Route::get('/film/{id}/edit', [FilmController::class, 'edit'])
    ->middleware(['admin'])->name('film.edit');
Route::patch('/film/{id}/edit', [FilmController::class, 'update'])
    ->middleware(['admin'])->name('film.update');
Route::get('/film/{id}', [FilmController::class, 'show'])
    ->name('film.show');

/*REVIEW*/
Route::get('review/create', [ReviewController::class, 'create'])->middleware('auth')->name('review.create');
Route::post('review/create', [ReviewController::class, 'store'])
    ->middleware('auth')->name('review.store');
Route::delete('review/{id}/delete', [ReviewController::class, 'destroy'])->middleware('auth')->name('review.delete');
//Route::post('review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
Route::patch('review/{id}/edit', [ReviewController::class, 'update'])->middleware('auth')->name('review.update');

Route::post('review/set-like', [ReviewController::class, 'setLike'])->middleware('auth')->name('review.setLike');
Route::post('review/set-dislike', [ReviewController::class, 'setDislike'])->middleware('auth')->name('review.setDislike');
Route::get('review/{id}/get-likes', [UserReviewReactionController::class, 'getLikes'])->name('review.getLikes');
Route::get('review/{id}/get-dislikes', [UserReviewReactionController::class, 'getDislikes'])->name('review.getDislikes');

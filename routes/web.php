<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
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
    ->name('users.register');
Route::post('/register', [UserController::class, 'store'])
    ->name('users.store');

/*USER DASHBOARD*/
Route::get('/users/{$id}/dashboard', [UserController::class, 'dashboard'])
    ->name('users.dashboard');
Route::get('/users/{id}/data', [UserController::class, 'showData'])
    ->name('users.show.data');
Route::get('/users/{id}/reviews', [UserController::class, 'showReviews'])
    ->name('users.show.reviews');
Route::get('/users/{id}/admin', [UserController::class, 'showAdminPanel'])
    ->middleware('admin')->name('users.show.admin');
Route::get('/users/{id}/admin/users', [UserController::class, 'index'])
    ->middleware('admin')->name('users.show.admin.users');
Route::get('/users/{id}/admin/films', [FilmController::class, 'index'])
    ->middleware('admin')->name('users.show.admin.films');
Route::get('/users/{id}/admin/genres', [GenreController::class, 'index'])
    ->middleware('admin')->name('users.show.admin.genres');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])
    ->middleware('admin')->name('users.delete');
Route::post('users/update/name', [UserController::class, 'updateName'])
    ->name('users.update.name');
Route::post('users/update/email', [UserController::class, 'updateEmail'])
    ->name('users.update.email');
Route::post('users/update/avatar', [UserController::class, 'updateAvatar'])
    ->name('users.update.avatar');
Route::post('users/update/password', [UserController::class, 'updatePassword'])
    ->name('users.update.password');
Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');

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
Route::get('/films/genre/{genreSlug}', [FilmController::class, 'genre'])
    ->name('films.genre');
Route::get('/films/search', [FilmController::class, 'search'])
    ->name('films.search');
Route::get('/films/create', [FilmController::class, 'create'])
    ->middleware('admin')->name('films.create');
Route::post('/films/create', [FilmController::class, 'store'])
    ->middleware(['admin'])->name('films.store');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])
    ->middleware(['admin'])->name('films.delete');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])
    ->middleware(['admin'])->name('films.edit');
Route::patch('/films/{id}/edit', [FilmController::class, 'update'])
    ->middleware(['admin'])->name('films.update');
Route::get('/films/{id}', [FilmController::class, 'show'])
    ->name('films.show');

/*REVIEW*/
Route::get('reviews/create', [ReviewController::class, 'create'])->middleware('auth')
    ->name('reviews.create');
Route::post('reviews/create', [ReviewController::class, 'store'])
    ->middleware('auth')->name('reviews.store');
Route::delete('reviews/{id}/delete', [ReviewController::class, 'destroy'])->middleware('auth')
    ->name('reviews.delete');
//Route::post('review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
Route::patch('reviews/{id}/edit', [ReviewController::class, 'update'])->middleware('auth')
    ->name('reviews.update');

Route::post('reviews/set-like', [ReviewController::class, 'setLike'])->middleware('auth')
    ->name('reviews.setLike');
Route::post('reviews/set-dislike', [ReviewController::class, 'setDislike'])
    ->middleware('auth')->name('reviews.setDislike');
Route::get('reviews/{id}/get-likes', [UserReviewReactionController::class, 'getLikes'])
    ->name('reviews.getLikes');
Route::get('reviews/{id}/get-dislikes', [UserReviewReactionController::class, 'getDislikes'])
    ->name('reviews.getDislikes');

//GENRES
Route::post('/genres/create', [GenreController::class, 'store'])
    ->name('genres.store');
Route::delete('/genres/{id}/delete', [GenreController::class, 'destroy'])->middleware('admin')->name('genres.delete');

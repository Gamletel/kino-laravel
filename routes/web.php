<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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
Route::get('/user/dashboard', [UserController::class, 'dashboard'])
    ->middleware('auth')->name('user.dashboard');
Route::post('user/update/name', [UserController::class, 'updateName'])
    ->name('user.update.name');
Route::post('user/update/email', [UserController::class, 'updateEmail'])
    ->name('user.update.email');
Route::post('user/update/password', [UserController::class, 'updatePassword'])
    ->name('user.update.password');
Route::get('/user/{id}', [UserController::class, 'show'])
    ->name('user.show');
//Route::get('/user/{id}/reviews', [UserController::class, 'show'])->name('user.reviews');

/*FILMS*/
Route::get('/films', [FilmController::class, 'index'])->name('films');
Route::get('/film/create', [FilmController::class, 'create'])
    ->name('film.create');
Route::post('/film/create', [FilmController::class, 'store'])
    ->middleware(['admin'])->name('film.store');
Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.show');
Route::get('/film/{id}/edit', [FilmController::class, 'edit'])
    ->middleware(['admin'])->name('film.edit');
Route::patch('/film/{id}/edit', [FilmController::class, 'update'])
    ->middleware(['admin'])->name('film.update');

Route::get('review/create', [ReviewController::class, 'create'])->name('review.create');
Route::post('review/create', [ReviewController::class, 'store'])
    ->middleware('auth')->name('review.store');

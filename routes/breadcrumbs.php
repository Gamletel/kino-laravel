<?php
// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Film;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
//Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//    $trail->push('Home', route('home'));
//});

// Films
Breadcrumbs::for('films', function (BreadcrumbTrail $trail) {
//    $trail->parent('home');
    $trail->push('Films', route('films'));
});

// Films > Film
Breadcrumbs::for('film', function (BreadcrumbTrail $trail, int $id) {
    $film = Film::find($id);
    $trail->parent('films');
    $trail->push($film->name, route('film.show', $id));
});

//User
Breadcrumbs::for('user.show', function (BreadcrumbTrail $trail, int $id){
    $trail->push('Профиль', route('user.show', $id));
});

//User > Data
Breadcrumbs::for('user.show.data', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('user.show', $id);
    $trail->push('Данные', route('user.show.data', $id));
});

//User > Reviews
Breadcrumbs::for('user.show.reviews', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('user.show', $id);
    $trail->push('Отзывы', route('user.show.reviews', $id));
});

// Home > Blog > [Category]
//Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category));
//});

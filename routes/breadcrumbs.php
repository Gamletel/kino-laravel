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

// Home > Blog > [Category]
//Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category));
//});

<?php
// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Film;
use App\Models\Genre;
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
    $trail->push('Фильмы', route('films'));
});

// Films > Genre
Breadcrumbs::for('films.genre', function (BreadcrumbTrail $trail, int $id) {
    $genre = Genre::find($id);
    $trail->parent('films');
    $trail->push($genre->name, route('films.genre', $genre->slug));
});

// Films > Film
Breadcrumbs::for('film', function (BreadcrumbTrail $trail, int $id) {
    $film = Film::find($id);
    $trail->parent('films');
    $trail->push($film->name, route('films.show', $id));
});

// Films > Create
Breadcrumbs::for('films.create', function (BreadcrumbTrail $trail) {
    $trail->parent('films');
    $trail->push('Новый фильм');
});

//User
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, int $id){
    $trail->push('Профиль', route('users.show', $id));
});
//User > Data
Breadcrumbs::for('users.show.data', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('users.show', $id);
    $trail->push('Данные', route('users.show.data', $id));
});
//User > Reviews
Breadcrumbs::for('users.show.reviews', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('users.show', $id);
    $trail->push('Отзывы', route('users.show.reviews', $id));
});
//User > Admin Panel
Breadcrumbs::for('users.show.admin', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('users.show', $id);
    $trail->push('Админ панель', route('users.show.admin', $id));
});
//User > Admin Panel > Users
Breadcrumbs::for('users.show.admin.users', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('users.show.admin', $id);
    $trail->push('Пользователи', route('users.show.admin.users', $id));
});
//User > Admin Panel > Genres
Breadcrumbs::for('users.show.admin.genres', function (BreadcrumbTrail $trail, int $id){
    $trail->parent('users.show.admin', $id);
    $trail->push('Жанры фильмов', route('users.show.admin.genres', $id));
});

// Home > Blog > [Category]
//Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category));
//});

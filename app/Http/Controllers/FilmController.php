<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class FilmController extends Controller
{
    public function index(): View
    {
        $films = Film::all();

        Redis::set('films', serialize($films));
        $filmsFromRedis = unserialize(Redis::get('films'));

        return view('film.index', [
            'films' => $filmsFromRedis ?? $films
        ]);
    }

    public function show(int $id): View
    {
        $film = Film::find($id);

        Redis::set('film' . $id, serialize($film));
        $filmFromRedis = unserialize(Redis::get('film' . $id));

        return view('film.show', [
            'film' => $filmFromRedis ?? $film
        ]);
    }

    public function create(): JsonResponse
    {
        $film = Film::factory()->create();

        return response()->json($film);
    }

    public function store()
    {
        $film = Film::factory()->make();

        return response()->json($film);
    }

    public function edit(int $id)
    {
        $film = Film::where('id', $id)->first();

        return response()->json($film);
    }

    public function update(Request $request)
    {
        //
    }
}

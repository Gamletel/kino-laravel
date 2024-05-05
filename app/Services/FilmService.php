<?php

namespace App\Services;

use App\Models\Film;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class FilmService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Film::paginate(6);
    }

    public function show(int $id): Film
    {
        return Cache::remember('film_' . $id, 60 * 60, function () use ($id) {
            return Film::find($id);
        });
    }

    public function create(): Film
    {
        $film = Film::factory()->create();

        $films = Cache::remember('films', 60 * 60, function () {
            return Film::all();
        });
        $films->push($film);
        Cache::put('films', $films, 60 * 60);

        return Cache::remember('film_' . $film->id, 60 * 60, function () use ($film) {
            return Film::find($film->id);
        });
    }

    public function destroy(int $id): void
    {
        $film = Film::findOrFail($id);
        $film->delete();

        Cache::forget('films');
        Cache::remember('films', 60 * 60, function () {
            return Film::all();
        });
    }
}

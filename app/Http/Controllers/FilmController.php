<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;
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
        $films = Cache::remember('films', 60*60, function (){
            return Film::all();
        });

        return view('film.index', compact('films'));
    }

    public function show(int $id): View
    {
        $film = Cache::remember('film_'.$id, 60*60, function () use ($id){
            return Film::find($id);
        } );
        $reviews = Review::where('film_id', $id)->orderBy('created_at', 'desc')->get();

        return view('film.show', [
            'film' => $film,
            'reviews' => $reviews,
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

<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FilmController extends Controller
{
    public function index(): View
    {
        $films = Film::all();

        return view('film.index', compact('films'));
    }

    public function show(int $id): View
    {
        $film = Film::find($id);

        return view('film.show', compact('film'));
    }

    public function create(): \Illuminate\Http\JsonResponse
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

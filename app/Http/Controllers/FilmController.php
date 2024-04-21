<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Services\FilmService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmController extends Controller
{
    private FilmService $filmService;

    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
    }
    public function index(): View
    {
        $films = $this->filmService->index();

        return view('film.index', compact('films'));
    }

    public function show(int $id): View
    {
        $film = $this->filmService->show($id);

        $reviews = $film->reviews;

        return view('film.show', compact(['film', 'reviews']));
    }

    public function create(): JsonResponse
    {
        $film = $this->filmService->create();

        return response()->json($film);
    }

    public function store():JsonResponse
    {
        $film = Film::factory()->make();

        return response()->json($film);
    }

    public function edit(int $id):JsonResponse
    {
        $film = Film::where('id', $id)->first();

        return response()->json($film);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(string $id):RedirectResponse
    {
        $this->filmService->destroy($id);
        return back();
    }
}

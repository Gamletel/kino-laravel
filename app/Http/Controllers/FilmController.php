<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Models\Film_Genre;
use App\Models\Genre;
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

        $genres = Genre::all();

        return view('film.index', compact('films', 'genres'));
    }

    public function genre(String $genreSlug)
    {
        $genre = Genre::where('slug', $genreSlug)->first();
        $film_genres = Film_Genre::where('genre_id', $genre->id)->get();
        $filmIds = $film_genres->pluck('film_id')->toArray();
        $films = Film::whereIn('id', $filmIds)->paginate(6);

        $genres = Genre::all();

        return view('film.genre', compact('films', 'genre', 'genres'));
    }

    public function search(Request $request): View
    {
        $films = Film::search($request->input('name'))->paginate(6);

        return view('film.index', compact('films'));
    }

    public function show(int $id): View
    {
        $film = $this->filmService->show($id);

        $reviews = $film->reviews;

        $filmGenres = $film->film_genres;

        if ($filmGenres) {
            $genreIds = $filmGenres->pluck('genre_id')->toArray();
            $genres = Genre::whereIn('id', $genreIds)->get();
        } else {
            $genres = collect(); // Пустая коллекция
        }

        return view('film.show', compact(['film', 'reviews', 'genres']));
    }

    public function create(): View
    {
        $genres = Genre::all();
        return view('film.create', compact('genres'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>['required', 'string'],
            'date'=>['nullable', 'string'],
            'description'=>['nullable', 'string'],
        ]);

        $film = Film::create([
            'name'=>$data['name'],
            'date'=>$data['date'],
            'description'=>$data['description'],
        ]);

        $film->save();

        if (!empty($request->genres)){
            foreach ($request->genres as $genre) {
                $film_genre = Film_Genre::create([
                    'film_id'=>$film->id,
                    'genre_id'=>$genre
                ]);
            }
        }

        return redirect()->route('films.show', $film->id);
    }

    public function edit(int $id):View
    {
        $film = Film::find($id);

        return view('film.edit', compact('film'));
    }

    public function update(int $id, UpdateFilmRequest $request)
    {
        $data = $request->validated();

        $film = Film::find($id);
        $film->name = $data['name'];
        $film->date = $data['date'];
        $film->description = $data['description'];
        $film->save();

        return back();
    }

    public function destroy(string $id):RedirectResponse
    {
        $this->filmService->destroy($id);
        return back();
    }
}

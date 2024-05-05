<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct(private GenreService $genreService)
    {}

    public function index():View
    {
        $user = auth()->user();
        $genres = $this->genreService->index();
        return view('user.admin.genres', compact('genres', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>['required', 'string'],
            'slug'=>['required', 'string'],
        ]);

        $genre = Genre::create($data);
        $genre->save();

        return back();
    }

    public function destroy(int $id)
    {
        $genre = Genre::find($id);
        $genre->delete();

        return response()->json([
            'status'=>'Жанр: ' . $genre->name. ' успешно удален!',
            'id'=>$id]);
    }
}

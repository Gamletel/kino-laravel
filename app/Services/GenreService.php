<?php

namespace App\Services;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(): Collection
    {
        return Genre::all();
    }
}

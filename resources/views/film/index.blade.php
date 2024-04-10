@extends('templates.base')

@section('content')
    <h1 class="text-center">Фильмы</h1>

    @isset($films)
        <div class="row row-cols-3">
            @foreach($films as $film)
                    <x-film-card :film="$film" />
            @endforeach
        </div>
    @endisset

    @empty($films)
        <h2 class="text-center">Фильмов не найдено</h2>
    @endempty
@endsection

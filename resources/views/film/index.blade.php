@extends('templates.base')

@section('content')
    <h1 class="text-center">Фильмы</h1>

    @if(auth()->check() && auth()->user()->admin)
        <a href="{{ route('films.create') }}" class="btn btn-primary mb-3">Создать фильм</a>
    @endif

    @if(!empty($films))
        <form action="{{ route('films.search') }}" method="get" class="form-group">
            <div class="input-group mb-3">
                <x-input name="name" placeholder="Название"/>

                <button class="btn btn-sm btn-outline-primary" type="submit">Найти</button>
            </div>
        </form>

        @if(!empty($genres))
            <div class="genres dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Жанры
                </button>

                <ul class="dropdown-menu dropdown-menu-primary">
                    @foreach($genres as $genre)
                        <li>
                            <a href="{{ route('films.genre', $genre->slug) }}"
                               class="genre dropdown-item">{{__($genre->name)}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row row-cols-3">
            @foreach($films as $film)
                <x-film-card :film="$film"/>
            @endforeach
        </div>

        {{ $films->links() }}
    @endif

    @empty($films)
        <h2 class="text-center">Фильмов не найдено</h2>
    @endempty
@endsection

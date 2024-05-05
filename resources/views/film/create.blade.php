@extends('templates.base')

@section('content')
    {{ Breadcrumbs::render('films.create') }}

    <h1 class="text-center">Создание фильма</h1>

    <form action="{{ route('films.create')}}" method="post" class="d-flex flex-column gap-3">
        @csrf

        <x-input-group>
            <x-label for="name">Название</x-label>

            <x-input id="name" name="name"/>
        </x-input-group>

        <x-input-group>
            <x-label for="date">Дата выхода</x-label>

            <x-input type="date" name="date" id="date"/>
        </x-input-group>

        <x-input-group class="flex-nowrap">
            <x-label for="description">Описание</x-label>

            <textarea name="description" id="description" style="width: 100%;">

            </textarea>
        </x-input-group>

        @if(!empty($genres))
            <x-input-group class="genres">
                <x-label>Жанры</x-label>

                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach($genres as $genre)
                        <input type="checkbox" name="genres[]" id="{{$genre->slug}}" value="{{$genre->id}}" class="btn-check">
                        <label class="btn btn-outline-primary" for="{{$genre->slug}}">{{__($genre->name)}}</label>
                    @endforeach
                </div>
            </x-input-group>
        @endif

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection

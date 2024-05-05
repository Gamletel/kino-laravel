@extends('templates.base')

@section('content')
    {{ Breadcrumbs::render('film', $film->id) }}

    <h1 class="text-center">Редактирование фильма: {{__($film->name)}}</h1>

    <form action="{{ route('films.update', $film->id)}}" method="post" class="d-flex flex-column gap-3">
        @csrf
        @method('patch')

        <x-input-group>
            <x-label for="name">Название</x-label>

            <x-input value="{{__($film->name)}}" id="name" name="name"/>
        </x-input-group>

        <x-input-group>
            <x-label for="date">Дата выхода</x-label>

            <x-input type="date" name="date" id="date" value="{{__($film->date)}}"/>
        </x-input-group>

        <x-input-group class="flex-nowrap">
            <x-label for="description">Описание</x-label>

            <textarea name="description" id="description" style="width: 100%;">
                {{__($film->description)}}
            </textarea>
        </x-input-group>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection

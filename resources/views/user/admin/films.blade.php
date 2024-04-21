@extends('user.admin')

@section('admin.content')
    @if(!empty($films))
        <div class="row row-cols-3">
            @foreach($films as $film)
                <x-film-card :film="$film"/>
            @endforeach
        </div>

    @else
        <h2 class="text-center">Фильмов не найдено</h2>
    @endif
@endsection

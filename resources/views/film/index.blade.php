@extends('templates.base')

@section('content')
    @if(!empty($films))
        <div class="row row-cols-3">
            @foreach($films as $film)
                    <x-film-card :film="$film" />
            @endforeach
        </div>
    @endif
@endsection

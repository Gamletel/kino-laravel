@php use App\Models\Review; @endphp
@extends('templates.base')
@php
    $id = $film->id;
    $name = $film->name;
    $date = $film->date;
    $description = $film->description;

    $reviews = Review::where('film_id', $id);
@endphp

@section('content')
    <h1 class="text-center">{{__($name)}}</h1>

    <p>Дата выхода: @if($date)
            {{__($date)}}
        @else
            -
        @endif</p>

    <p class="lead w-50">О фильме: {{__($description)}}</p>

    <div class="border border-primary">
        <h3>Отзывы:</h3>

        @if(!empty($reviews))

        @else
            <h5>Отзывов нет. Станьте первым!</h5>
        @endif
    </div>
@endsection

@php
    use App\Models\Review;
    use App\Models\User;
@endphp

@extends('templates.base')

@php
    $id = $film->id;
    $name = $film->name;
    $date = $film->date;
    $description = $film->description;

    $controller = app()->make(\App\Http\Controllers\ReviewController::class);

    $reviews = call_user_func_array([$controller, 'getFilmReviews'], [$id]);
@endphp

@section('content')
    {{ Breadcrumbs::render('film', $id) }}

    <h1 class="text-center">{{__($name)}}</h1>

    <p>Дата выхода: @if($date)
            {{__($date)}}
        @else
            -
        @endif</p>

    <p class="lead w-50">О фильме: {{__($description)}}</p>

    <div class="border border-primary p-3">
        @auth()
            <form action="{{ route('review.store') }}" method="post" id="send-review" class="p-2 mb-3 border border-primary d-flex flex-column gap-2 needs-validation
        @if($errors->any()) was-validated @endif">
                <h5>Оставить отзыв</h5>

                @csrf

                <x-input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                <x-input type="hidden" name="film_id" value="{{$id}}"/>

                <x-input-group>
                    <x-label for="stars" required>Оценка:</x-label>
                    <x-input type="range" name="stars" id="stars" min="0" max="5" class="form-range h-auto"/>
                </x-input-group>

                <x-input-group>
                    <x-label for="title">Заголовок:</x-label>
                    <x-input type="text" name="title" id="title"/>
                </x-input-group>

                <x-input-group>
                    <x-label for="text">Отзыв:</x-label>
                    <x-input name="text" id="text"/>
                </x-input-group>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        @endauth

        <h3>Отзывы:</h3>
        <div id="reviews-container">
            @if(!empty($reviews))
                @foreach($reviews as $review)
                    <x-review-card :review="$review"/>
                @endforeach
            @else
                <h5>Отзывов нет. Станьте первым!</h5>
            @endif
        </div>
    </div>

    {{--<script>
        $(document).ready(function () {
            $('#send-review').on('submit', function (e) {
                let inputs = $(this).find('input');
                e.preventDefault(); // Отменить стандартное поведение отправки формы

                $.ajax({
                    url: $(this).attr('action'), // URL-адрес маршрута Laravel
                    type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
                    data: $(this).serialize(), // Сериализовать данные формы
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
                    },
                    success: function (response) {
                        let reviewCard = $(`<x-review-card :review="$review" />`).get(0);
                        reviewCard = reviewCard.outerHTML.replace('$review', JSON.stringify(response.review));
                        $('#reviews-container').prepend(reviewCard);

                        inputs.val('');
                    },
                    error: function (error) {
                    }
                });
            });
        });
    </script>--}}
@endsection

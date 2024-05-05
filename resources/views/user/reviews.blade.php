@php
    use App\Models\Film;
@endphp

@extends('user.dashboard')

@section('dashboard.content.title')
    Отзывы
@endsection

@section('dashboard.content')
    <div class="col vstack gap-3">
        <h4>Отзывы:</h4>

        @if(!empty($reviews))
            <div class="d-flex flex-column gap-1">
                @foreach($reviews as $review)
                    <div class="review-card card">
                        <div class="card-header d-flex gap-2 justify-content-between flex-wrap-reverse align-items-end">
                            <div class="d-flex flex-column gap-1">
                                <a href="{{ route('films.show', $review->film_id)}}#review-{{$review->id}}">
                                    <h4 class="review-user-name">
                                        {{__(Film::find($review->film_id)->name)}}
                                    </h4>
                                </a>

                                <p class="review-stars" data-value="{{$review->stars}}">Оценка: <span
                                        class="value">{{__($review->stars)}}</span>/5</p>
                            </div>

                            @if(auth()->check() && $review->user_id == auth()->id() || auth()->check() && auth()->user()->admin)
                                <div class="btn-group h-100">
                                    <div class="edit-review-btn btn btn-outline-primary btn-sm"
                                         data-bs-toggle="modal" data-bs-target="#editReview"
                                         data-review-id="{{ $review->id }}">
                                        Редактировать
                                    </div>

                                    <button class="delete-review-btn btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#deleteReview"
                                            data-review-id="{{ $review->id }}">Удалить
                                    </button>
                                </div>
                            @endif
                        </div>

                        @if($review->title || $review->text)
                            <div class="card-body">

                                @if($review->title)
                                    <h5 class="card-title review-title">{{__($review->title)}}</h5>
                                @endif

                                @if($review->text)
                                    <p class="card-text review-text">{{__($review->text)}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

        @else
            <h5 class="text-center">Вы пока что не оставляли отзывы.</h5>
        @endif
    </div>
@endsection

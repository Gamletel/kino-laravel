@php
    use App\Http\Controllers\UserReviewReactionController;
    use App\Models\User;

    $user = User::find($review->user_id);
    $reactionController = app(UserReviewReactionController::class);
    $likes = $reactionController->getLikes($review->id);
    $dislikes = $reactionController->getDislikes($review->id);

    if(auth()->check()){
        $user_liked_review = $reactionController->checkUserLike(auth()->id(), $review->id) ? 'active' : '';
        $user_disliked_review = $reactionController->checkUserdisLike(auth()->id(), $review->id) ? 'active' : '';
    }
@endphp
<div id="review-{{ $review->id }}" class="review-card card mb-2">
    <div class="card-header d-flex gap-2 justify-content-between flex-wrap-reverse align-items-end">
        <div class="d-flex flex-column gap-1">
            <a href="{{route('users.show', $user->id)}}" class="review-user-info d-flex align-items-center gap-1">

                @if($user->avatar)
                    <div class="review-user-avatar overflow-hidden rounded" style="width: 50px; height: 50px">
                        <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="w-100 h-100 object-fit-contain">
                    </div>
                @endif


                <h4 class="review-user-name mb-0">
                    {{__($user->name)}}
                </h4>
            </a>

            <p class="review-stars" data-value="{{$review->stars}}">Оценка: <span class="value">{{__($review->stars)}}</span>/5</p>
        </div>

        @if($user->id == auth()->id())
            <div class="btn-group h-100">
                <div class="edit-review-btn btn btn-outline-primary btn-sm"
                     data-bs-toggle="modal" data-bs-target="#editReview" data-review-id="{{ $review->id }}">Редактировать
                </div>

                <button class="delete-review-btn btn btn-outline-primary btn-sm"
                        data-bs-toggle="modal" data-bs-target="#deleteReview" data-review-id="{{ $review->id }}">Удалить
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
                <p class="card-text review-text">{!! $review->text !!}</p>
            @endif


            @if(auth()->check())
                <div class="btn-group btn-group-sm">
                    <form class="like-form" action="{{route('reviews.setLike')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="review_id" value="{{ $review->id }}">

                        <button type="submit" class="like-btn btn btn-outline-primary btn-sm
                        {{ $user_liked_review }} ">
                            @svg('like.svg', 'sprite')

                            <span class="count">{{ $likes }}</span>
                        </button>
                    </form>

                    <form class="dislike-form" action="{{route('reviews.setDislike')}}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="review_id" value="{{ $review->id }}">

                        <button type="submit"
                                class="dislike-btn btn btn-outline-danger btn-sm {{ $user_disliked_review }}">
                            @svg('dislike.svg', 'sprite')

                            <span class="count">{{ $dislikes }}</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endif
</div>

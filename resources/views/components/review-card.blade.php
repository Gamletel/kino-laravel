@php
    use App\Models\User;
    $user = User::find($review->user_id);
    $id = $review->id;
    $stars = $review->stars;
    $title = $review->title;
    $text = $review->text;
@endphp
<div class="review-card card mb-2">
    <div class="card-header d-flex justify-content-between flex-wrap-reverse align-items-end">
        <div class="d-flex flex-column gap-1">
            <h4 class="review-user-name">
                {{__($user->name)}}
            </h4>

            <p class="review-stars" data-value="{{$stars}}">Оценка: <span class="value">{{__($stars)}}</span>/5</p>
        </div>

        <?php if ($user->id == auth()->id()) {?>
            <div class="btn-group h-100">
                <div class="edit-review-btn btn btn-outline-primary btn-sm"
                     data-bs-toggle="modal" data-bs-target="#editReview" data-review-id="{{ $id }}">Редактировать</div>

                <button class="delete-review-btn btn btn-outline-primary btn-sm"
                        data-bs-toggle="modal" data-bs-target="#deleteReview" data-review-id="{{ $id }}">Удалить</button>
            </div>
        <?php } ?>
    </div>

    @if($title || $text)
        <div class="card-body">

            @if($title)
                <h5 class="card-title review-title">{{__($title)}}</h5>
            @endif

            @if($text)
                <p class="card-text review-text">{{__($text)}}</p>
            @endif
        </div>
    @endif
</div>

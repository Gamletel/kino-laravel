<div class="p-1">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            @if($film->date)
                <p><small>{{__($film->date)}}</small></p>
            @endif

            <h5 class="film-card__name card-title">{{__($film->name)}}</h5>

            @if($film->description)
                <p class="film-card__description card-text">{{__($film->description)}}</p>
            @endif

            <a href="{{route('film.show', $film->id)}}" class="btn btn-primary mt-auto">Подробнее</a>
        </div>
    </div>
</div>

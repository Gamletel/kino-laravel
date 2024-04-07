@php
    $id = $film->id;
    $name = $film->name;
    $description = $film->description;
    $date = $film->date;
@endphp
<div class="p-1">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            @if($date)
                <p><small>{{__($date)}}</small></p>
            @endif

            <h5 class="film-card__name card-title">{{__($name)}}</h5>

            @if($description)
                <p class="film-card__description card-text">{{__($description)}}</p>
            @endif

            <a href="{{route('film.show', $id)}}" class="btn btn-primary mt-auto">Подробнее</a>
        </div>
    </div>
</div>

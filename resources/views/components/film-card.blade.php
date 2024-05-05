<div class="p-1">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            @if($film->date)
                <p><small>{{__($film->date)}}</small></p>
            @endif

            <h5 class="film-card__name card-title">{{__($film->name)}}</h5>

            @if($film->description)
                <div class="film-card__description card-text">{!! $film->description !!}</div>
            @endif

            <a href="{{route('films.show', $film->id)}}" class="btn btn-primary mt-auto">Подробнее</a>
        </div>

        @if(auth()->check() && auth()->user()->admin)
            <div class="card-footer">
                <div class="btn-group btn-group-sm">
                    <form action="{{ route('films.delete', $film->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <button type="submit" class="btn btn-sm btn-outline-primary">Удалить</button>
                    </form>

                    <a href="{{route('films.edit', $film->id)}}" class="btn btn-sm btn-outline-primary">Редактировать</a>
                </div>
            </div>
        @endif
    </div>
</div>

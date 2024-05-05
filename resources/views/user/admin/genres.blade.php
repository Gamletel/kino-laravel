@extends('user.admin')

@section('admin.content')
    <div class="content">
        <form action="{{route('genres.store')}}" method="post" class="form mb-3">
            @csrf
            <h4>Создать жанр</h4>

            <div class="form-floating mb-3">
                <x-input id="floatingName" name="name" placeholder=""/>
                <label for="floatingName">Название</label>
            </div>

            <div class="form-floating mb-3">
                <x-input id="floatingSlug" name="slug" placeholder=""/>
                <label for="floatingSlug">Slug</label>
            </div>

            <button type="submit" class="btn btn-primary">
                Создать
            </button>
        </form>

        @if(!empty($genres))
            <div class="genres d-flex flex-column gap-2 w-100">
                @foreach($genres as $genre)
                    <div class="genre card" id="genre-card-{{__($genre->id)}}">
                        <div class="card-header">
                            <h5 class="genre__name">{{__($genre->name)}}</h5>

                            <h6 class="genre__slug">{{__($genre->slug)}}</h6>
                        </div>

                        <div class="card-footer">
                            <button class="delete-genre-btn btn btn-outline-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#deleteGenre"
                                    data-genre-id="{{ $genre->id }}" data-genre-name="{{$genre->name}}">Удалить
                            </button>

                            <div class="btn btn-sm btn-primary">Редактировать</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3>Жанров пока что нет</h3>
        @endif
    </div>
@endsection

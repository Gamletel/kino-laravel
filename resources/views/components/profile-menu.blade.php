<div class="btn-group mb-3 w-100">
    <a href="{{route('user.show.data', $id)}}"
       class="btn btn-primary @if(url()->current() == route('user.show.data', $id)) active @endif ">Данные</a>

    <a href="{{route('user.show.reviews', $id)}}"
       class="btn btn-primary @if(url()->current() == route('user.show.reviews', $id)) active @endif">Отзывы</a>

    @if(auth()->user()->admin)
        <a href="{{route('user.show.admin', $id)}}"
           class="btn btn-primary @if(url()->current() == route('user.show.admin', $id)) active @endif">Админ панель</a>
    @endif
</div>

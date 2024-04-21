<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container d-flex justify-content-between gap-3">
    @auth()
        <div class="btn-group btn-group-sm btn-group-vertical">
            <a href="{{route('users.show', auth()->id())}}" class="btn btn-link btn-sm">Профиль</a>
        <a href="/logout" class="btn btn-link">Выйти</a>
        </div>
    @endauth

    @guest()
        <div class="btn-group btn-group-sm btn-group-vertical">
            <a href="{{route('login')}}" class="btn btn-link btn-sm">Вход</a>
            <a href="{{route('users.register')}}" class="btn btn-link btn-sm">Регистрация</a>
        </div>
    @endguest

        <a href="{{route('films')}}" class="btn btn-link btn-sm">Фильмы</a>
</div>

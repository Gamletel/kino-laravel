@php use Illuminate\Support\Facades\Storage; @endphp
@extends('templates.base')

@php($user = auth()->user())

@section('content')
    <h1 class="text-center mb-3">Профиль</h1>
    <img src="{{ asset('images/'.$user->avatar) }}" alt="">

    <div class="col vstack gap-3">
        <x-profile-menu/>


        <h4>Ваши данные:</h4>


        <div class="d-flex gap-3">
            <div class="p-2 d-flex gap-1">Имя:
                <div id="user-name">{{__($user->name)}}</div>
            </div>

            <a href="#update-name" data-bs-toggle="collapse" role="button" class="btn btn-primary">
                Изменить
            </a>

            <form action="{{route('user.update.name')}}" method="post" id="update-name"
                  class="collapse collapse-horizontal">
                @csrf
                <div class="d-flex gap-1 ">
                    <x-input name="name" placeholder="Иван Иванов" required/>

                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </form>
        </div>

        <div class="d-flex gap-3 align-items-start">
            <div class="p-2 d-flex gap-1">Email:
                <div id="user-email">{{__($user->email)}}</div>
            </div>

            <a href="#update-email" data-bs-toggle="collapse" role="button" class="btn btn-primary">
                Изменить
            </a>

            <form action="{{route('user.update.email')}}" method="post" id="update-email"
                  class="collapse collapse-horizontal needs-validation">
                @csrf
                <div class="d-flex gap-1 align-items-start">
                    <div class="w-50">
                        <x-input type="email" name="email" placeholder="example@example.com" required/>

                        <div id="email" class="text-danger">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </form>
        </div>

        @if(!$user->hasVerifiedEmail())
            <div class="alert alert-danger">
                Почта не подтверждена! Письмо с подтверждением отправлено на почту.
            </div>

            <form action="{{ route('verification.send') }}" method="POST" class="d-flex flex-column gap-1">
                @csrf
                <div class="alert alert-info">Письмо не пришло?</div>
                <input type="hidden" value="{{ auth()->user() }}">

                <button type="submit" href="" class="btn btn-outline-primary">
                    Отправить снова
                </button>
            </form>
        @endif

        <div class="d-flex flex-column gap-1 align-items-start">
            <div class="span-2">Настройки пароля</div>
            <form action="{{route('user.update.password')}}" method="post" id="update-password"
                  class="needs-validation">
                @csrf
                <div class="d-flex flex-column gap-1 align-items-start">
                    <x-input-group>
                        <x-label for="password" required>Старый пароль:</x-label>
                        <x-input type="password" name="password" id="password" required/>
                    </x-input-group>

                    <x-input-group>
                        <x-label for="password_new" required>Новый пароль:</x-label>
                        <x-input type="password" name="password_new" id="password_new" required/>
                    </x-input-group>

                    <div id="password-message" class="text-danger">
                    </div>

                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#update-name').on('submit', function (e) {
                let input = $(this).find('input');
                e.preventDefault(); // Отменить стандартное поведение отправки формы

                $.ajax({
                    url: $(this).attr('action'), // URL-адрес маршрута Laravel
                    type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
                    data: $(this).serialize(), // Сериализовать данные формы
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
                    },
                    success: function (response) {
                        // Обновить данные на странице
                        $('#user-name').text(response.name);
                    },
                    error: function (error) {
                    }
                });
            });

            $('#update-email').on('submit', function (e) {
                let form = $(this);
                let input = $(this).find('input');
                e.preventDefault(); // Отменить стандартное поведение отправки формы

                $.ajax({
                    url: $(this).attr('action'), // URL-адрес маршрута Laravel
                    type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
                    data: $(this).serialize(), // Сериализовать данные формы
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
                    },
                    success: function (response) {
                        // Обновить данные на странице
                        input.removeClass('is-invalid');
                        input.addClass('is-valid');
                        $('#user-email').text(response.email);
                    },
                    error: function (error) {
                        // Код, который выполняется при ошибке запроса
                        // $('#email').html(error.responseJSON.errors['email']);
                        input.removeClass('is-valid');
                        input.addClass('is-invalid');


                        // form.addClass('was-validated');
                        console.log(error);
                    }
                });
            });
        });
    </script>


    {{--    <p>{{ asset('storage/'.$user->avatar) }}</p>--}}
    {{--    <img src="{{ asset('storage/'.$user->avatar) }}" alt="" style="width: 250px; height: 250px;">--}}
@endsection

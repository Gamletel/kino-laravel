@extends('user.dashboard')

@section('dashboard.content.title')
    Данные
@endsection

@section('dashboard.content')
    <div class="col vstack gap-3">
        <h4>Ваши данные:</h4>

        <div class="d-flex gap-3 align-items-center">
            <div class="p-2 d-flex gap-1 align-items-center">
                <h6 class="mb-0">
                    Изображение:
                </h6>

                <div id="user-avatar" style="width: 75px; height: 75px;" class="border border-primary">
                    @if($user->avatar)
                        <img src="{{ asset('storage/'.$user->avatar) }}"
                             style="width: 100%; height: 100%; object-fit: contain" alt="">
                    @endif
                </div>
            </div>

            @if($user->id == auth()->id())
                <a href="#update-avatar" data-bs-toggle="collapse" role="button" class="btn btn-primary">
                    Изменить
                </a>

                <form action="{{route('users.update.avatar')}}" method="post" id="update-avatar"
                      class="collapse collapse-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex gap-1 ">
                        <x-input type="file" name="avatar" required/>

                        <button type="submit" class="btn btn-primary">Подтвердить</button>
                    </div>
                </form>
            @endif
        </div>

        <div class="d-flex gap-3">
            <div class="p-2 d-flex gap-1 align-items-center">
                <h6 class="mb-0">
                    Имя:
                </h6>

                <div id="user-name">{{__($user->name)}}</div>
            </div>

            @if($user->id == auth()->id())
                <a href="#update-name" data-bs-toggle="collapse" role="button" class="btn btn-primary">
                    Изменить
                </a>

                <form action="{{route('users.update.name')}}" method="post" id="update-name"
                      class="collapse collapse-horizontal">
                    @csrf
                    <div class="d-flex gap-1 ">
                        <x-input name="name" placeholder="Иван Иванов" required/>

                        <button type="submit" class="btn btn-primary">Подтвердить</button>
                    </div>
                </form>
            @endif
        </div>

        <div class="d-flex gap-3 align-items-start">
            <div class="p-2 d-flex gap-1 align-items-center">
                <h6 class="mb-0">
                    Email:
                </h6>

                <div id="user-email">{{__($user->email)}}</div>
            </div>

            @if($user->id == auth()->id())
                <a href="#update-email" data-bs-toggle="collapse" role="button" class="btn btn-primary">
                    Изменить
                </a>

                <form action="{{route('users.update.email')}}" method="post" id="update-email"
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
            @endif
        </div>

        @if($user->id == auth()->id())
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
                <form action="{{route('users.update.password')}}" method="post" id="update-password"
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
        @endif
    </div>
@endsection

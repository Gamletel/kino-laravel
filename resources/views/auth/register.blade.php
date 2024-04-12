@extends('templates.base')

@section('content')
    <div class="container">
        <form action="{{ route('user.store') }}" class="d-flex flex-column gap-2 needs-validation
        @if($errors->any())
        was-validated
        @endif"

              method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-input-group>
                    <x-label for="avatar">Изображение профиля</x-label>
                    <x-input type="file" name="avatar" accept="image/*"/>
                </x-input-group>

                <x-input-group class="col">
                    <x-label for="name">Введите имя</x-label>
                    <x-input id="name" type="text" name="name" placeholder="Имя"/>
                </x-input-group>

                <x-input-group class="col has-validation">
                    <x-label for="email" required>Введите почту</x-label>
                    <x-input id="email" type="email" name="email" placeholder="email"/>

                    <x-input-feedback id="email"/>
                </x-input-group>
            </div>

            <div class="row">
                <div class="col">
                    <x-input-group class="has-validation">
                        <x-label for="password" required>Введите пароль</x-label>
                        <x-input id="password" type="password" name="password" placeholder="Пароль" required/>
                    </x-input-group>
                </div>

                <div class="col">
                    <x-input-group class="has-validation">
                        <x-label for="password_confirmation" required>Повторите пароль</x-label>
                        <x-input id="password_confirmation" type="password" name="password_confirmation"
                                 placeholder="Пароль" required/>
                        <x-input-feedback id="password"/>
                    </x-input-group>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
@endsection

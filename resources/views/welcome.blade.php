@extends('templates.base')

@section('content')
    <div class="container-sm">
        <div class="text-center row">Кино)</div>

        <div class="btn-group">
            <a href="{{route('users.register')}}" class="btn btn-primary text-center">Регистрация</a>

            <a href="{{route('login')}}" class="btn btn-primary text-center">Вход</a>
        </div>
    </div>
@endsection

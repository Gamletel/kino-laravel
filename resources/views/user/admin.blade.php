@extends('user.dashboard')

@section('dashboard.content.title')
    Админ панель
@endsection

@section('dashboard.content')
    <div class="d-flex gap-3">
        <div class="btn-group btn-group-vertical w-auto h-100 sticky-top">
            <a href="{{route('users.show.admin.users', auth()->id())}}" class="btn btn-outline-primary btn-sm
            @if(url()->current() == route('users.show.admin.users', auth()->id())) active @endif">Пользователи</a>
            <a href="{{route('users.show.admin.films', auth()->id())}}" class="btn btn-outline-primary btn-sm
            @if(url()->current() == route('users.show.admin.films', auth()->id())) active @endif">Фильмы</a>
            <div class="btn btn-outline-primary btn-sm">Отзывы</div>
        </div>

        @yield('admin.content')
    </div>
@endsection

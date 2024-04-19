@extends('user.dashboard')

@section('dashboard.content.title')
    Админ панель
@endsection

@section('dashboard.content')
    <div class="d-flex gap-3">
        <div class="btn-group btn-group-vertical w-auto h-100 sticky-top">
            <a href="{{route('user.show.admin.users', auth()->id())}}" class="btn btn-outline-primary btn-sm
            @if(url()->current() == route('user.show.admin.users', auth()->id())) active @endif">Пользователи</a>
            <div class="btn btn-outline-primary btn-sm">Фильмы</div>
            <div class="btn btn-outline-primary btn-sm">Отзывы</div>
        </div>

        @yield('admin.content')
    </div>
@endsection

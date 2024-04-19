@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('templates.base')

@section('content')
    <h1 class="text-center mb-3">
        @yield('dashboard.content.title')
        @isset($user)
            пользователя {{__($user->name)}}
        @endisset
    </h1>

    {{ Breadcrumbs::render(Route::getCurrentRoute()->action['as'], $user->id) }}

    <x-profile-menu :id="$user->id"/>

    @yield('dashboard.content')
@endsection

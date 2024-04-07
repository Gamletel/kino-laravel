@extends('templates.base')

@section('content')
    <div class="container">
        <form action="{{ route('login.post') }}" method="post" class="d-flex flex-column gap-2 needs-validation
        @if($errors->any())
        was-validated
        @endif">
            @csrf

            <x-input-group>
                <x-label required>Email:</x-label>
                <x-input type="email" name="email" placeholder="example@example.com" required/>
                <x-input-feedback id="email" />
            </x-input-group>

            <x-input-group>
                <x-label required>Пароль:</x-label>
                <x-input type="password" name="password" required/>
                <x-input-feedback id="password" />
            </x-input-group>

            <div class="form-check">
            <input type="checkbox" name="remember_me" id="remember_me" class="form-check-input">

                <label for="remember_me" class="form-check-label">Запомнить меня</label>
            </div>

            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection

@extends('layouts.main')
@section('title')
    Авторизация
@endsection
@section('content')
<section class="auth">
    <div class="auth__container container">
        <h1 class="auth__title">Вход в аккаунт</h1>
        <form class="auth__form" action="{{route('login.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="email" class="auth__label">
                <span class="auth__text">Введите email: </span>
                <input type="email" class="auth__input" name="email"  placeholder="Email" value="{{old('email')}}">
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
            </label>
            <label for="password" class="auth__label">
                <span class="auth__text">Введите пароль: </span>
                <input type="password" class="auth__input" name="password" placeholder="Пароль" value="{{old('password')}}">
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
            </label>
            <button type="submit">Отправить</button>
            <label for="remember" class="auth__label" id="remember_label">
                <input type="checkbox" name="remember" id="remember">
                <span class="auth__text">Запонмить меня</span>
                <form action="{{route('forget.index')}}">
                    @csrf
                    <a href="{{route('forget.index')}}">Забыли пароль</a>
                </form>
            </label>

        </form>
    </div>
</section>
@endsection



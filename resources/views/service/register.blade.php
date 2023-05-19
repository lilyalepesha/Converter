@extends('layouts.main')
@section('title')
    Регистрация
@endsection
@section('content')
    <section class="register">
        <div class="register__container container">
            <h1 class="register__title">Форма регистрации</h1>
            <form class="register__form" action="{{route("register.store")}}" method="post">
                @csrf
                <label for="name" class="register__label">
                    <span class="register__text">Введите имя: </span>
                    <input value="{{old('name')}}" type="text" class="register__input" name="name" placeholder="Имя">
                    @error('name')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>

                <label for="email" class="register__label">
                    <span class="register__text">Введите email: </span>
                    <input value="{{old('email')}}" type="email" class="register__input" name="email"  placeholder="Email">
                    @error('email')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>

                <label for="password" class="register__label">
                    <span class="register__text">Введите пароль: </span>
                    <input value="{{old('password')}}" type="password" class="register__input" name="password" placeholder="Пароль">
                    @error('password')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>
                <label for="password_confirmation" class="register__label">
                    <span class="register__text">Подтвердите пароль: </span>
                    <input value="{{old('password_confirmation')}}" type="password" class="register__input" name="password_confirmation" placeholder="Повторите пароль">
                </label>
                <button class="register__button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
